<?php

namespace Modules\Lists\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Lists\Http\Controllers';

    /**
     * Define the routes for the application.
     */
    public function map() : void
    {
        $this->mapApiRoutes();

        dd('InshaAllah will work');

        // $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes() : void
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Lists', 'routes/web.php'));
            dd('test');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes() : void
    {

        dd('test');

        Route::prefix(\Modules\Core\Application::API_PREFIX)
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Lists', 'routes/api.php'));
    }
}
