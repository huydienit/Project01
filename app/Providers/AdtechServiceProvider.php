<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AdtechServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /** template service **/
        $this->app->register('Adtech\Templates\TemplatesServiceProvider');

        /** register optional **/
        if (($moduleConfigs = Config::get('site.modules'))) {
            foreach ($moduleConfigs as $package => $modules) {
                if ($modules) {
                    foreach ($modules as $module) {
                        $moduleData = explode('-', $module);
                        $moduleNamespace = null;
                        foreach ($moduleData as $k => $v) {
                            $moduleNamespace .= ucfirst($v);
                        }
                        $namespace = ucfirst($package) . '\\' . $moduleNamespace . '\\' . $moduleNamespace . 'ServiceProvider';
                        $this->app->register($namespace);
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
        /** application service **/
        $this->app->register('Adtech\Application\ApplicationServiceProvider');
    }
}
