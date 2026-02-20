<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $modules = File::directories(app_path('Modules'));

        foreach ($modules as $module) {

            $moduleName = basename($module);

            $provider =
                "App\\Modules\\{$moduleName}\\Providers\\{$moduleName}ServiceProvider";

            if (class_exists($provider)) {
                $this->app->register($provider);
            }
        }
    }

    public function boot(): void
    {
        $modules = File::directories(app_path('Modules'));

        foreach ($modules as $module) {

            $routesPath = $module . '/Routes';

            if (!File::exists($routesPath)) continue;

            $versions = File::directories($routesPath);

            foreach ($versions as $version) {

                $apiFile = $version . '/api.php';

                if (File::exists($apiFile)) {
                    Route::middleware('api')
                        ->prefix('api')
                        ->group($apiFile);
                }
            }
        }
    }
}
