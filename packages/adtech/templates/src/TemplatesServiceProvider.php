<?php

namespace Adtech\Templates;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class TemplatesServiceProvider extends ServiceProvider
{
    private $_namespace = 'ADTECH-TEMPLATE';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $environment = strtolower(getenv('APP_ENV'));
        $groupName = config('site.group_name');
        $groupName = $groupName ? $groupName : 'default';
        switch ($environment) {
//            case 'production':
//                $templateDir = 'resources/views';
//                $desktopTemplate = config('site.desktop.template');
//                $desktopTemplate = $desktopTemplate ? $desktopTemplate : 'default';
//
//                $templateName = $groupName . '/' . $desktopTemplate;
//                $pathTemplateDir = realpath(__DIR__.'/' . $templateName . '/views');
//                $this->loadViewsFrom(base_path($templateDir . '/' . $templateName), $this->_namespace);
//                $this->app['view']->addLocation(base_path($templateDir . '/' . $templateName));
//
//                $this->publishes([
//                    $pathTemplateDir => base_path($templateDir . '/' . $templateName),
//                ]);
//                break;
            case 'local':
            default:
                $desktopTemplate = config('site.desktop.template');
                $desktopTemplate = $desktopTemplate ? $desktopTemplate : 'default';
                $templateName = $groupName . '/' . $desktopTemplate;
                $this->app['view']->addLocation(realpath(__DIR__ . '/' . $templateName . '/views'));
                break;
        }

        /** publishes **/
        $skin = config('site.desktop.skin');
        $skin = $skin ? $skin : 'default';
        $this->publishes([
            __DIR__ . '/' . $groupName . '/' . $skin . '/public' => public_path('vendor/' . $groupName . '/' . $skin),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //include __DIR__.'/routes.php';
        //$this->app->make('Adtech\Templates\TemplatesController');

    }
}
