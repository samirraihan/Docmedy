<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'module:make {name}';
    protected $description = 'Create a new versioned module structure';

    public function handle()
    {
        $module = $this->argument('name');

        $basePath = app_path("Modules/{$module}");

        $folders = [
            "Controllers/Api/V1",
            "Requests/V1",
            "Resources/V1",
            "Services",
            "Repositories",
            "DTO",
            "Routes/V1",
            "Tests",
            "Interfaces",
            "Providers",
            "Actions",
        ];

        foreach ($folders as $folder) {
            $path = "{$basePath}/{$folder}";
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        $this->info("Module {$module} created successfully.");
    }
}
