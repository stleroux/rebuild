<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class CrudGeneratorCommand extends Command
{

    protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';


    protected $description = 'Create CRUD operations';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        // Get the name of the argument
        $name = $this->argument('name');

        // Create the files
        $this->info('Creating controller');
        $this->controller($name);
        
        $this->info('Creating model');
        $this->model($name);

        $this->info('Creating request');
        $this->request($name);

        $this->info('Creating Create view');
        $this->createView($name);

        $this->info('Creating Delete view');
        $this->deleteView($name);

        $this->info('Creating Edit view');
        $this->editView($name);

        $this->info('Creating Index view');
        $this->indexView($name);

        $this->info('Creating Show view');
        $this->showView($name);

        $this->info('Creating form');
        $this->showForm($name);

        // Add resource controller to routes files
        $this->info('Adding resource route');
        File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');"). "<br />";

        // Create a migration file
        $this->info('Creating migration');
        \Artisan::call('make:migration', 
            [
                'name'=>'create_' . strtolower(Str::plural($name)) . '_table',
                '--create'=>strtolower(Str::plural($name))
            ]
        );

        $this->info('');
        $this->info('Done. Don\' forget to update the migration file and then run "php artisan migrate"');

    }


    protected function getStub($type)
    {
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
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/".Str::plural($name)."Controller.php"), $template);
    }


    protected function createView($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/create')
        );

        if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)))))
            mkdir($path, 0777, true);

        file_put_contents(resource_path("/views/".Str::plural($name)."/create.blade.php"), $template);
    }


    protected function deleteView($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/delete')
        );

        file_put_contents(resource_path("/views/".Str::plural($name)."/delete.blade.php"), $template);
    }


    protected function editView($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/edit')
        );

        file_put_contents(resource_path("/views/".Str::plural($name)."/edit.blade.php"), $template);
    }


    protected function indexView($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/index')
        );

        file_put_contents(resource_path("/views/".Str::plural($name)."/index.blade.php"), $template);
    }


    protected function showView($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/show')
        );

        file_put_contents(resource_path("/views/".Str::plural($name)."/show.blade.php"), $template);
    }


    protected function showForm($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $name,                          // Place
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub('views/form')
        );

        file_put_contents(resource_path("/views/".Str::plural($name)."/form.blade.php"), $template);
    }


}
