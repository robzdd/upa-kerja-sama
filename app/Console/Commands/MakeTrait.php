<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTrait extends Command
{
    protected $signature = 'make:trait {name}';
    protected $description = 'Create a new trait file';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Traits/{$name}.php");

        if (File::exists($path)) {
            $this->error("Trait {$name} already exists!");
            return;
        }

        if (!File::isDirectory(app_path('Traits'))) {
            File::makeDirectory(app_path('Traits'));
        }

        $stub = "<?php\n\nnamespace App\Traits;\n\ntrait {$name}\n{\n    //\n}\n";

        File::put($path, $stub);

        $this->info("Trait {$name} created successfully at app/Traits");
    }
}
