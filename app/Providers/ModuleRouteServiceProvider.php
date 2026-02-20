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

            $routePath = $module . '/Routes/V1/api.php';

            if (File::exists($routePath)) {
                Route::middleware('api')
                    ->prefix('api')
                    ->group($routePath);
            }
        }
    }
}
