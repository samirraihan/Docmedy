<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModuleController extends Command
{
    protected $signature = 'module:make-controller {module} {name}';
    protected $description = 'Create controller inside module';

    public function handle()
    {
        $module = $this->argument('module');
        $name = $this->argument('name');

        $path = app_path("Modules/{$module}/Controllers/Api/V1");

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filePath = "{$path}/{$name}.php";

        $content = "<?php

namespace App\Modules\\{$module}\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class {$name} extends Controller
{
    //
}";

        File::put($filePath, $content);

        $this->info("Controller created: {$filePath}");
    }
}
