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


        $this->info('Creating necessary folders');
        $this->createFolders($name);

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

        $this->info('Creating Form View');
        $this->formView($name);

        // Add resource controller to routes files
        $this->info('Adding resource route');
        File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');\n");

        // Create a migration file
        $this->info('Creating migration');
        \Artisan::call('make:migration', 
            [
                'name'=>'create_' . strtolower(Str::plural($name)) . '_table',
                '--create'=>strtolower(Str::plural($name))
            ]
        );

        $this->info('======================================================================================');
        $this->info('Almost there.');
        $this->info('Don\'t forget to:');
        $this->info('-> Update the migration file and then run "php artisan migrate"');
        $this->info('-> Update the views');
        $this->info('-> Update the form');
        $this->info('======================================================================================');
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
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/create.blade.php"), $this->getTemplate('views/create'));
    }


    protected function deleteView($name)
    {
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/delete.blade.php"), $this->getTemplate('views/delete'));
    }


    protected function editView($name)
    {
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/edit.blade.php"), $this->getTemplate('views/edit'));
    }


    protected function indexView($name)
    {
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/index.blade.php"), $this->getTemplate('views/index'));
    }


    protected function showView($name)
    {
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/show.blade.php"), $this->getTemplate('views/show'));
    }


    protected function formView($name)
    {
        file_put_contents(resource_path("/views/".strtolower(Str::plural($name))."/form.blade.php"), $this->getTemplate('views/form'));
    }


    protected function getTemplate($viewName)
    {
        return $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}',
            ],
            [
                $this->name,                          // Place
                strtolower(Str::plural($this->name)), // places
                strtolower($this->name),              // place
                Str::plural($this->name)              // Places
            ],
            $this->getStub($viewName)
        );
    }


    protected function createFolders($name)
    {
        if(!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        // Create folder for views if it doesn't exist already
        if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)))))
            mkdir($path, 0777, true);
    }

}
