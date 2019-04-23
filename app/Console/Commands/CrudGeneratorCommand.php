<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class CrudGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD operations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the name of the argument
        $name = $this->argument('name');

        // Create the files
        $this->controller($name);
        $this->model($name);
        $this->request($name);

        // Add resource controller to routes files
        File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');");

        // Create a migration file
        // Artisan::call('make:migration create_' . strtolower(Str::plural($name)) . '_table --create=' . strtolower(Str::plural($name)));
        // Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true));
        \Artisan::call('make:migration', 
            [
                'name'=>'create_' . strtolower(Str::plural($name)) . '_table',
                '--create'=>strtolower(Str::plural($name))
            ]
        );

    }

    protected function getStub($type)
    {
        // return file_get_contents(resource_path("\stubs\'" . $type . ".stub"));
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/{$name}.php"), $template);
    }

    protected function request($name)
    {
        $template = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $template);
    }

    protected function controller($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name, // Place
                strtolower(Str::plural($name)), //places
                strtolower($name), // place
                Str::plural($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/".Str::plural($name)."Controller.php"), $template);
        
    }

}
