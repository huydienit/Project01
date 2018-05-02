<?php

namespace Adtech\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $vendor = 'adtech';

    /**
     * @var string
     */
    protected $package = 'api';

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

        $this->app['router']->middlewareGroup('jwt.auth', ['\Tymon\JWTAuth\Middleware\GetUserFromToken']);
        $this->app['router']->middlewareGroup('jwt.refresh', ['Tymon\JWTAuth\Middleware\RefreshToken']);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
