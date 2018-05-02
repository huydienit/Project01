<?php

namespace Adtech\Application;

use Illuminate\Routing\Router;
use Illuminate\Support\Composer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem as Filesystem;
use Illuminate\Foundation\Http\Kernel as Kernel;
use Adtech\Application\Cms\Package\Console\Commands\MakePackageCommand;
use Adtech\Application\Cms\Module\Console\Commands\MakeModuleCommand;
use Adtech\Application\Cms\Repositories\Console\Commands\MakeCriteriaCommand;
use Adtech\Application\Cms\Repositories\Console\Commands\MakeRepositoryCommand;
use Adtech\Application\Cms\Repositories\Console\Commands\Creators\CriteriaCreator;
use Adtech\Application\Cms\Repositories\Console\Commands\Creators\RepositoryCreator;
use Adtech\Application\Cms\Package\Console\Commands\Creators\PackageCreator;
use Illuminate\Support\Facades\Route;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        /** set adtech exceptions **/
        $this->app->singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            config('site.exception_handler', \App\Exceptions\Handler::class)
        );

        $share = array(
            'APP_GROUP_NAME' => config('site.group_name'),
            'APP_TEMPLATE' => config('site.desktop.template'),
            'APP_SKIN' => config('site.desktop.skin')
        );
        view()->share($share);

        $this->app->setLocale(config('app.locale'));

        $homepageConfigs = config('site.homepage');
        if ($homepageConfigs) {
            foreach ($homepageConfigs as $k => $homepageConfig) {
                $method = $homepageConfig['method'];
                if ($k == 'backend') {
                    switch ($method) {
                        case 'get':
                            $this->app['router']->group(array('prefix' => config('site.admin_prefix')), function ($router) {
                                $homepageConfig = config('site.homepage.backend');
                                $router->middlewareGroup('web', $homepageConfig['middleware'])
                                    ->get($homepageConfig['uri'], $homepageConfig['action'])
                                    ->name('backend.homepage');
                            });
                            break;
                    }
                } else {
                    switch ($method) {
                        case 'get':
                            $this->app['router']->middlewareGroup('web', $homepageConfig['middleware'])
                                ->get($homepageConfig['uri'], $homepageConfig['action'])
                                ->name('frontend.homepage');
                            break;
                    }
                }
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $serverInfo = $this->app->request->server();
        $host = isset($serverInfo['SERVER_NAME']) ? $serverInfo['SERVER_NAME'] : null;

        if ($host) {
            $configPath = __DIR__ . '/configs/' . $host;
            $ls = @scandir($configPath);
            if ($ls) {
                foreach ($ls as $index => $filename) {
                    $ext = substr($filename, -3);
                    if ($ext != 'php' || $filename == '.') {
                        continue;
                    }

                    if (($overrideConfig = require_once($configPath . '/' . $filename))) {
                        // Merge config.
                        $this->mergeConfigFrom(
                            __DIR__ . '/../config/packages.php',
                            'packages'
                        );

                        foreach ($overrideConfig as $k => $v) {
                            $this->app['config']->set(explode('.', $filename)[0] . '.' . $k, $v);
                        }
                    }
                }
            }
        }

        // Merge config.
        $this->mergeConfigFrom(
            __DIR__ . '/../config/packages.php',
            'packages'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../config/repositories.php',
            'repositories'
        );

        // Register bindings.
        $this->registerBindings();

        // Register make module command.
        $this->registerMakePackageCommand();

        // Register make module command.
        $this->registerMakeModuleCommand();

        // Register make repository command.
        $this->registerMakeRepositoryCommand();

        // Register make criteria command.
        $this->registerMakeCriteriaCommand();
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        // FileSystem.
        $this->app->instance('FileSystem', new Filesystem());

        // Composer.
        $this->app->bind('Composer', function ($app) {
            return new Composer($app['FileSystem']);
        });

        // Package creator.
        $this->app->singleton('PackageCreator', function ($app) {
            return new PackageCreator($app['FileSystem']);
        });

        // Repository creator.
        $this->app->singleton('RepositoryCreator', function ($app) {
            return new RepositoryCreator($app['FileSystem']);
        });

        // Criteria creator.
        $this->app->singleton('CriteriaCreator', function ($app) {
            return new CriteriaCreator($app['FileSystem']);
        });
    }

    /**
     * Register the make:package command.
     */
    protected function registerMakePackageCommand()
    {
        // Make package command.
        $this->app->singleton('command.package.make', function ($app) {
            return new MakePackageCommand($app['PackageCreator'], $app['Composer']);
        });

        $this->commands('command.package.make');
    }

    /**
     * Register the make:module command.
     */
    protected function registerMakeModuleCommand()
    {
        // Make module command.
        $this->app->singleton('command.module.make', function ($app) {
            return new MakeModuleCommand();
        });

        $this->commands('command.module.make');
    }

    /**
     * Register the make:repository command.
     */
    protected function registerMakeRepositoryCommand()
    {
        // Make repository command.
        $this->app->singleton('command.repository.make', function ($app) {
            return new MakeRepositoryCommand($app['RepositoryCreator'], $app['Composer']);
        });

        $this->commands('command.repository.make');
    }

    /**
     * Register the make:criteria command.
     */
    protected function registerMakeCriteriaCommand()
    {
        // Make criteria command.
        $this->app->singleton('command.criteria.make', function ($app) {
            return new MakeCriteriaCommand($app['CriteriaCreator'], $app['Composer']);
        });

        $this->commands('command.criteria.make');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.package.make',
            'command.module.make',
            'command.repository.make',
            'command.criteria.make'
        ];
    }
}
