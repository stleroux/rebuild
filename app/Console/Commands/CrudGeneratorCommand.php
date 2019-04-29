<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;
use DB;

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

        if ($this->confirm('Do you wish to create the Controller?')) {
            $this->controller($name);
            $this->info('Controller created');
        }
        
        if ($this->confirm('Do you wish to create the Model?')) {
            $this->model($name);
            $this->info('Model created');
        }

        if ($this->confirm('Do you wish to create the Request?')) {
            $this->request($name);
            $this->info('Request created');
        }
        
        if ($this->confirm('Do you wish to create the views?')) {
            $this->createFolders($name);
                $this->info('Necessary folders created');
            $this->indexView($name);
                $this->info('Index view created');
            $this->createView($name);
                $this->info('Create view was created');
            $this->showView($name);
                $this->info('Show view created');
            $this->editView($name);
                $this->info('Edit view created');
            $this->deleteView($name);
                $this->info('Delete view was created');
            $this->showForm($name);
                $this->info('Form view created');
        }

        if ($this->confirm('Do you wish to add base permissions to the database?')) {
            $this->addPermissions($name);
            $this->info('Base permissions added to database');
        }

        if ($this->confirm('Do you wish to add related routes?')) {
            File::append(base_path('routes/web.php'),'Route::get(\'' . strtolower(Str::plural($name)) . "/{test}/delete', '" . (Str::plural($name)) . "Controller@delete')->name('" . strtolower(Str::plural($name)) . ".delete');\n");
            File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');\n");
            $this->info('Route resource added to web.php routes file');
        }

        if ($this->confirm('Do you wish to create the migration file?')) {
            \Artisan::call('make:migration', 
                [
                    'name'=>'create_' . strtolower(Str::plural($name)) . '_table',
                    '--create'=>strtolower(Str::plural($name))
                ]
            );
            $this->info('Migration created');
            $this->info('Don\'t forget to update the migration file and then run "php artisan migrate"');
        }

        $this->info('Done! Happy coding.');
    }


    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }


    protected function model($name)
    {
        file_put_contents(
            app_path("/{$name}.php"),
            $this->getTemplate('Model', $name));
    }


    protected function request($name)
    {
        file_put_contents(
            app_path("/Http/Requests/{$name}Request.php"),
            $this->getTemplate('Request', $name));
    }


    protected function controller($name)
    {
        file_put_contents(
            app_path("/Http/Controllers/".Str::plural($name)."Controller.php"),
            $this->getTemplate('Controller', $name));
    }


    protected function createView($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/create.blade.php"),
            $this->getTemplate('views/create', $name));
    }


    protected function deleteView($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/delete.blade.php"),
            $this->getTemplate('views/delete', $name));
    }


    protected function editView($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/edit.blade.php"),
            $this->getTemplate('views/edit', $name));
    }


    protected function indexView($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/index.blade.php"),
            $this->getTemplate('views/index', $name));
    }


    protected function showView($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/show.blade.php"),
            $this->getTemplate('views/show', $name));
    }


    protected function showForm($name)
    {
        file_put_contents(
            resource_path("/views/".strtolower(Str::plural($name))."/form.blade.php"),
            $this->getTemplate('views/form', $name)
        );
    }


    protected function getTemplate($viewName, $name)
    {
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNameUpperCase}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePlural}}'
            ],
            [
                $name,                          // Place
                strtoupper($name),              // PLACE
                strtolower(Str::plural($name)), // places
                strtolower($name),              // place
                Str::plural($name)              // Places
            ],
            $this->getStub($viewName)
        );
    }


    protected function createFolders($name)
    {
        if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)))))
        {
            mkdir($path, 0777, true);
        }

        if(!file_exists($path = app_path('/Http/Requests')))
        {
            mkdir($path, 0777, true);
        }
            
    }


    protected function addPermissions($name)
    {
        DB::table('permissions')->insert([
            [
                // index permission
                'name' => strtolower($name).'_index',
                'display_name' => 'index',
                'model' => strtolower($name),
                'type' => 0,
                'description' => 'list '.strtolower($name)
            ],
            [
                // create permission
                'name' => strtolower($name).'_create',
                'display_name' => 'create',
                'model' => strtolower($name),
                'type' => 0,
                'description' => 'create '.strtolower($name)
            ],
            [
                // edit permission
                'name' => strtolower($name).'_edit',
                'display_name' => 'edit',
                'model' => strtolower($name),
                'type' => 0,
                'description' => 'edit '.strtolower($name)
            ],
            [
                // show permission
                'name' => strtolower($name).'_show',
                'display_name' => 'show',
                'model' => strtolower($name),
                'type' => 0,
                'description' => 'view '.strtolower($name)
            ],
            [
                // delete permission
                'name' => strtolower($name).'_delete',
                'display_name' => 'delete',
                'model' => strtolower($name),
                'type' => 0,
                'description' => 'delete '.strtolower($name)
            ]
        ]);
    }



}
