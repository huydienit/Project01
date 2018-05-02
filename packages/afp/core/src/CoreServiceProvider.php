<?php

namespace Afp\Core;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $vendor = 'afp';

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
                }
            }
        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /** load views **/
        $this->loadViewsFrom(__DIR__ . '/views', strtoupper($this->package));
        /** load translations **/
        $this->loadTranslationsFrom(__DIR__ . '/translations', $this->vendor . '-' . $this->package);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
