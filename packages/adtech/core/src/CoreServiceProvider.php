<?php

namespace Adtech\Core;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $vendor = 'adtech';

    /**
     * @var string
     */
    protected $package = 'core';

    protected $namespace = __NAMESPACE__ . '\App\Http\Controllers';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $routesDir = __DIR__ . '/routes';
        $ls = @scandir($routesDir);
        if ($ls) {
            foreach ($ls as $index => $routeFile) {
                switch (substr($routeFile, 0, -4)) {
                    case 'web':
                        Route::middleware('web')
                            ->namespace($this->namespace)
                            ->group(__DIR__ . '/routes/web.php');
                    case 'api':
                        Route::prefix('api')
                            ->middleware('api')
                            ->namespace($this->namespace)
                            ->group(__DIR__ . '/routes/api.php');
                        break;
                }
            }
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /** load views **/
        $this->loadViewsFrom(__DIR__ . '/views', strtoupper($this->package));
        /** load translations **/
        $this->loadTranslationsFrom(__DIR__ . '/translations', $this->vendor . '-' . $this->package);

        $this->app['router']->middlewareGroup('adtech.auth', ['\Adtech\Core\App\Middleware\AuthMiddleware']);
        $this->app['router']->middlewareGroup('adtech.acl', ['\Adtech\Core\App\Middleware\AclMiddleware']);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
