<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class ModuleRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (!File::exists($modulesPath)) {
            return;
        }

        $modules = File::directories($modulesPath);

        foreach ($modules as $module) {

            $routesPath = $module . '/Routes';

            if (!File::exists($routesPath)) {
                continue;
            }

            // Detect versions automatically (V1, V2, V3...)
            $versions = File::directories($routesPath);

            foreach ($versions as $versionPath) {

                $apiFile = $versionPath . '/api.php';

                if (File::exists($apiFile)) {
                    Route::middleware('api')
                        ->prefix('api')
                        ->group($apiFile);
                }
            }
        }
    }
}
