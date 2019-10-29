<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;
use DB;

class CrudGeneratorCommand extends Command
{

   // protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';
   protected $signature = 'crud:generator';

   protected $description = 'Create CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }


   public function handle()
   {
      // Get the name of the argument
      // $name = $this->argument('name');
      $name = $this->ask('What is the name of the model? (Must be Capitalized singular form: i.e.: User)');

      $this->createFolders($name);
      $this->info('Frontend folders created');
      $this->createAdminFolders($name);
      $this->info('Admin folders created');


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Controllers
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to create the CONTROLLERS?')) {
         $this->controllers($name);
         $this->info('Frontend controllers created');
         $this->adminControllers($name);
         $this->info('Admin controllers created');
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Model
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to create the MODEL?')) {
         $this->model($name);
         $this->info('Model created');
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to create the VIEWS and ASSOCIATED FILES?')) {
         $this->addFrontendViews($name);
            $this->info('Frontend views created');
         $this->addFrontendButtons($name);
            $this->info('Frontend buttons added');
        $this->addAdminViews($name);
            $this->info('Admin views created');
         $this->addAdminButtons($name);
            $this->info('Admn buttons added');
      }





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the REQUEST?')) {
      //    $this->request($name);
      //    $this->info('Request created');
      // }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to add base PERMISSIONS to the database?')) {
         $this->addPermissions($name);
         $this->info('Base permissions added to database');
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to add related ROUTES?')) {
         File::append(base_path('routes/web.php'),'Route::get(\'' . strtolower(Str::plural($name)) . "/{test}/delete', '" . (Str::plural($name)) . "Controller@delete')->name('" . strtolower(Str::plural($name)) . ".delete');\n");
         File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');\n");
         $this->info('Route resource added to web.php routes file');
      }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if ($this->confirm('Do you wish to create the MIGRATION file?')) {
         // Create migration file using artisan command
         // \Artisan::call('make:migration', 
         //     [
         //         'name'=>'create_' . strtolower(Str::plural($name)) . '_table',
         //         '--create'=>strtolower(Str::plural($name))
         //     ]
         // );
         $this->makeMigration($name);
         $this->info('Migration created');
         $this->info('Don\'t forget to update the migration file and then run "php artisan migrate"');
      }

      $this->info('Done! Happy coding.');
   }










   protected function controllers($name)
   {
      file_put_contents(
         app_path("/Http/Controllers/" . Str::plural($name) . "/" . Str::plural($name) . "Controller.php"),
         $this->getTemplate('frontend/controllers/Controller', $name));

      file_put_contents(
         app_path("/Http/Controllers/" . Str::plural($name) . "/" . "ExtraViewsController.php"),
         $this->getTemplate('frontend/controllers/ExtraViewsController', $name));

      file_put_contents(
         app_path("/Http/Controllers/" . Str::plural($name) . "/" . "FunctionsController.php"),
         $this->getTemplate('frontend/controllers/FunctionsController', $name));
   }

   protected function adminControllers($name)
   {
      file_put_contents(
         app_path("/Http/Controllers/Admin/" . Str::plural($name) . "/" . Str::plural($name) . "Controller.php"),
         $this->getTemplate('admin/controllers/Controller', $name));

      file_put_contents(
         app_path("/Http/Controllers/Admin/" . Str::plural($name) . "/" . "ExtraViewsController.php"),
         $this->getTemplate('admin/controllers/ExtraViewsController', $name));

      file_put_contents(
         app_path("/Http/Controllers/Admin/" . Str::plural($name) . "/" . "FunctionsController.php"),
         $this->getTemplate('admin/controllers/FunctionsController', $name));
   }





   protected function getStub($type)
   {
      return file_get_contents(resource_path("stubs/$type.stub"));
   }


   protected function model($name)
   {
      file_put_contents(
         app_path("/Models/" . Str::plural($name) . "/" . $name . ".php"),
         $this->getTemplate('Model', $name));
   }


   // protected function request($name)
   // {
   //    file_put_contents(
   //       app_path("/Http/Requests/{$name}Request.php"),
   //       $this->getTemplate('Request', $name));
   // }



    protected function addViews($name)
   {
      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/index.blade.php"),
         $this->getTemplate('views/index', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/show.blade.php"),
         $this->getTemplate('views/show', $name));
   }

   protected function addAdminViews($name)
   {
      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/create.blade.php"),
         $this->getTemplate('views/create', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/delete.blade.php"),
         $this->getTemplate('views/delete', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/edit.blade.php"),
         $this->getTemplate('views/edit', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/index.blade.php"),
         $this->getTemplate('views/index', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/show.blade.php"),
         $this->getTemplate('views/show', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/form.blade.php"),
         $this->getTemplate('views/form', $name)
      );
   }


   protected function addButtons($name)
   {
      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/add.blade.php"),
         $this->getTemplate('views/buttons/add', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/save.blade.php"),
         $this->getTemplate('views/addins/buttons/save', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/edit.blade.php"),
         $this->getTemplate('views/buttons/edit', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/update.blade.php"),
         $this->getTemplate('views/addins/buttons/update', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/delete.blade.php"),
         $this->getTemplate('views/buttons/delete', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/back.blade.php"),
         $this->getTemplate('views/buttons/back', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/help.blade.php"),
         $this->getTemplate('views/buttons/help', $name)
      );
   }


   protected function makeMigration($name)
   {
      file_put_contents(
         database_path("/migrations/". date('Y_m_d_His') . "_create_" .strtolower(Str::plural($name))."_table.php"),
         $this->getTemplate('Migration', $name)
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
      if(!file_exists($path = app_path("/Http/Controllers/" . Str::plural($name))))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)))))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)) . "/buttons/")))
      {
         mkdir($path, 0777, true);
      }

      // if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)))))
      // {
      //    mkdir($path, 0777, true);
      // }

      // if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/buttons/")))
      // {
      //    mkdir($path, 0777, true);
      // }

      // if(!file_exists($path = app_path('/Http/Requests')))
      // {
      //    mkdir($path, 0777, true);
      // }
         
   }

   protected function createAdminFolders($name)
   {
      if(!file_exists($path = app_path("/Http/Controllers/Admin/" . Str::plural($name))))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = app_path("/Models/" . Str::plural($name))))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)))))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/buttons/")))
      {
         mkdir($path, 0777, true);
      }

      // if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)))))
      // {
      //    mkdir($path, 0777, true);
      // }

      // if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/buttons/")))
      // {
      //    mkdir($path, 0777, true);
      // }

      if(!file_exists($path = app_path('/Http/Requests')))
      {
         mkdir($path, 0777, true);
      }
         
   }

   protected function addPermissions($name)
   {
      $type = $this->choice('What section do the permissions need to be added to?',
         [0=>'Non-Core', 1=>'Core', 2=>'Module', ''=>'Select from above choices'], 2);

      DB::table('permissions')->insert([
         [
            // index permission
            'name' => strtolower(Str::plural($name)).'_index',
            'display_name' => 'index',
            'model' => strtolower($name),
            'type' => $type,
            'description' => 'list '.strtolower($name)
         ],
         [
            // create permission
            'name' => strtolower(Str::plural($name)).'_create',
            'display_name' => 'create',
            'model' => strtolower($name),
            'type' => $type,
            'description' => 'create '.strtolower($name)
         ],
         [
            // edit permission
            'name' => strtolower(Str::plural($name)).'_edit',
            'display_name' => 'edit',
            'model' => strtolower($name),
            'type' => $type,
            'description' => 'edit '.strtolower($name)
         ],
         [
            // show permission
            'name' => strtolower(Str::plural($name)).'_show',
            'display_name' => 'show',
            'model' => strtolower($name),
            'type' => $type,
            'description' => 'view '.strtolower($name)
         ],
         [
            // delete permission
            'name' => strtolower(Str::plural($name)).'_delete',
            'display_name' => 'delete',
            'model' => strtolower($name),
            'type' => $type,
            'description' => 'delete '.strtolower($name)
         ]
      ]);

      // Find newly added permissions (ids)
      $results = DB::select('select id from permissions where model = "' . strtolower($name) . '"');
      // Add permissions to admin account
      foreach($results as $r) {
         DB::table('permission_user')->insert(
            [
               'permission_id' => $r->id,
               'user_id' => 2
            ]);
      }
   }



}
