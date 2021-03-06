<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminApiRoutes();

        $this->mapApiRoutes();

        $this->mapWebRoutes();


        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "admin api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminApiRoutes()
    {
        $version = config('app.version',1);
        Route::prefix('api/admin/v'.$version)
             ->middleware('api')
             ->namespace("$this->namespace\Api\V$version\Admin")
             ->group(base_path('routes/admin_api.php'));
    }

    /**
     * Define the "admin api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $version = config('app.version',1);
        Route::prefix('api/v'.$version)
            ->middleware('api')
            ->namespace("$this->namespace\Api\V$version")
            ->group(base_path('routes/api.php'));
    }
}
