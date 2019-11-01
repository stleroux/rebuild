<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;
use DB;

// class CrudGeneratorCommand extends Command
class CrudAddCommand extends Command
{

   // protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';
   // protected $signature = 'crud:generator';
   protected $signature = 'crud:add {name}';

   protected $description = 'Create CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }


   public function handle()
   {
      // Get the name of the argument
      // $name = $this->argument('name');
      // $name = $this->ask('What is the name of the model? (Must be Capitalized singular form: i.e.: User)');

      $name = $this->argument('name');
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Folder structure
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // $this->createFrontendFolders($name);
      $this->createFrontendFolders($name);
      $this->info('Frontend folders created');
      $this->createAdminFolders($name);
      $this->info('Admin folders created');

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Controllers
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the CONTROLLERS?')) {
         $this->frontendControllers($name);
         $this->info('Frontend controllers created');
         $this->adminControllers($name);
         $this->info('Admin controllers created');
      // }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Model
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the MODEL?')) {
         $this->model($name);
         $this->info('Model created');
      // }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Views and buttons
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the VIEWS and ASSOCIATED FILES?')) {
         $this->addFrontendViews($name);
            $this->info('Frontend views created');
         $this->addFrontendButtons($name);
            $this->info('Frontend buttons added');
         $this->addFrontendBlocks($name);
            $this->info('Frontend blocks added');
// $this->addFrontendExtraPages($name);
// $this->info('Extra Pages added');
         $this->addFrontendMenuItem($name);
            $this->info('Frontend menu item added');

        $this->addAdminViews($name);
            $this->info('Admin views created');
         $this->addAdminButtons($name);
            $this->info('Admn buttons added');
         $this->addAdminBlocks($name);
            $this->info('Admn blocks added');
         $this->addAdminExtraPages($name);
            $this->info('Admin extra Pages added');
         $this->addAdminMenuItem($name);
            $this->info('Admin menu item added');
      // }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Request
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the REQUEST?')) {
         $this->request($name);
         $this->info('Request created');
      // }


      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Service Provider
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to create the SERVICE PROVIDER?')) {
         $this->serviceProvider($name);
         $this->info('Request created');
      // }


      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Permissions
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to add base PERMISSIONS to the database?')) {
      //    $this->addPermissions($name);
      //    $this->info('Base permissions added to database');
      // }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Routes
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // if ($this->confirm('Do you wish to add related ROUTES?')) {
         // File::append(base_path('routes/web.php'),'Route::get(\'' . strtolower(Str::plural($name)) . "/{test}/delete', '" . (Str::plural($name)) . "Controller@delete')->name('" . strtolower(Str::plural($name)) . ".delete');\n");
         // File::append(base_path('routes/web.php'), 'Route::resource(\'' . strtolower(Str::plural($name)) . "', '" . (Str::plural($name)) . "Controller');\n");
         $this->addRoutes($name);
         $this->info('Route resource added to web.php routes file');
      // }

      ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      // Migration
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
         $this->info('Migration file created');
      }






      $this->info('╔════════════════════════════════════════════════════════════════════════════════╗');
      $this->info('║ Done! Happy coding.                                                            ║');
      $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
      $this->info('║ NEXT STEPS:                                                                    ║');
      $this->info('║   - Update the migration file                                                  ║');
      $this->info('║   - Update the form for the Edit and Create page                               ║');
      $this->info('║                                                                                ║');
      $this->info('║ - Add the ServiceProvider class to config\app.php                              ║');
      $this->info('║                                                                                ║');
      $this->info('║                                                                                ║');
      $this->info('║   - Do not forget to run "php artisan migrate"                                 ║');
      $this->info('╚════════════════════════════════════════════════════════════════════════════════╝');
   }



// Check into modifying the file structure to allow the favorites block to be added to the Popular Items block on the homepage
// Add extra pages to frontend (favorites and archive)
// Add line to config/buttons for new icon
// Seed DB with data
// Popular block





   protected function frontendControllers($name)
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


   protected function request($name)
   {
      file_put_contents(
         app_path("/Http/Requests/{$name}Request.php"),
         $this->getTemplate('Request', $name));
   }


   protected function serviceProvider($name)
   {
      file_put_contents(
         app_path("/Providers/{$name}ServiceProvider.php"),
         $this->getTemplate('ServiceProvider', $name));
   }  


   protected function addFrontendViews($name)
   {
      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/index.blade.php"),
         $this->getTemplate('frontend/views/index', $name));

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/show.blade.php"),
         $this->getTemplate('frontend/views/show', $name));
   }

   protected function addAdminViews($name)
   {
      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/create.blade.php"),
         $this->getTemplate('admin/views/create', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/delete.blade.php"),
         $this->getTemplate('admin/views/delete', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/edit.blade.php"),
         $this->getTemplate('admin/views/edit', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/index.blade.php"),
         $this->getTemplate('admin/views/index', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/print.blade.php"),
         $this->getTemplate('admin/views/print', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/show.blade.php"),
         $this->getTemplate('admin/views/show', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/form.blade.php"),
         $this->getTemplate('admin/views/form', $name)
      );
   }


   protected function addAdminBlocks($name)
   {
      file_put_contents(
         resource_path("views/admin/".strtolower(Str::plural($name))."/blocks/" . "archives.blade.php"),
         $this->getTemplate('admin/blocks/archives', $name)
      );

      file_put_contents(
         resource_path("views/admin/".strtolower(Str::plural($name))."/blocks/" . "sidebar.blade.php"),
         $this->getTemplate('admin/blocks/sidebar', $name)
      );
   }


   protected function addFrontendBlocks($name)
   {
      file_put_contents(
         resource_path("views/".strtolower(Str::plural($name))."/blocks/" . "archives.blade.php"),
         $this->getTemplate('frontend/blocks/archives', $name)
      );
      file_put_contents(
         resource_path("views/".strtolower(Str::plural($name))."/blocks/" . "popular.blade.php"),
         $this->getTemplate('frontend/blocks/popular', $name)
      );
   }


   protected function addFrontendButtons($name)
   {
      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/add.blade.php"),
         $this->getTemplate('frontend/buttons/add', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/save.blade.php"),
         $this->getTemplate('frontend/buttons/save', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/edit.blade.php"),
         $this->getTemplate('frontend/buttons/edit', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/update.blade.php"),
         $this->getTemplate('frontend/buttons/update', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/delete.blade.php"),
         $this->getTemplate('frontend/buttons/delete', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/back.blade.php"),
         $this->getTemplate('frontend/buttons/back', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/help.blade.php"),
         $this->getTemplate('frontend/buttons/help', $name)
      );
   }


   protected function addAdminButtons($name)
   {
      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/add.blade.php"),
         $this->getTemplate('admin/buttons/add', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/back.blade.php"),
         $this->getTemplate('admin/buttons/back', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/delete.blade.php"),
         $this->getTemplate('admin/buttons/delete', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/edit.blade.php"),
         $this->getTemplate('admin/buttons/edit', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/help.blade.php"),
         $this->getTemplate('admin/buttons/help', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/publish.blade.php"),
         $this->getTemplate('admin/buttons/publish', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/publishAll.blade.php"),
         $this->getTemplate('admin/buttons/publishAll', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/trash.blade.php"),
         $this->getTemplate('admin/buttons/trash', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/trashAll.blade.php"),
         $this->getTemplate('admin/buttons/trashAll', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/unpublishAll.blade.php"),
         $this->getTemplate('admin/buttons/unpublishAll', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/save.blade.php"),
         $this->getTemplate('admin/buttons/save', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/update.blade.php"),
         $this->getTemplate('admin/buttons/update', $name)
      );
   }


// AddFrontendExtraPages


   protected function addAdminExtraPages($name)
   {
      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/archive.blade.php"),
         $this->getTemplate('admin/pages/archive', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/future.blade.php"),
         $this->getTemplate('admin/pages/future', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/my".Str::plural($name).".blade.php"),
         $this->getTemplate('admin/pages/my', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/new".Str::plural($name).".blade.php"),
         $this->getTemplate('admin/pages/new', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/showTrashed.blade.php"),
         $this->getTemplate('admin/pages/showTrashed', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/trashed.blade.php"),
         $this->getTemplate('admin/pages/trashed', $name));

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/unpublished.blade.php"),
         $this->getTemplate('admin/pages/unpublished', $name)
      );
   }


   protected function addFrontendMenuItem($name)
   {
      file_put_contents(
         resource_path("/views/blocks/menu/menuItems/".strtolower(Str::plural($name)).".blade.php"),
         $this->getTemplate('frontend/menu/item', $name)
      );
   }


   protected function addAdminMenuItem($name)
   {
      file_put_contents(
         resource_path("/views/admin/blocks/menu/menuItems/".strtolower(Str::plural($name)).".blade.php"),
         $this->getTemplate('admin/menu/item', $name)
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


   protected function createFrontendFolders($name)
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

      if(!file_exists($path = resource_path("/views/" . strtolower(Str::plural($name)) . "/blocks/")))
      {
         mkdir($path, 0777, true);
      }
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

      if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/blocks/")))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/buttons/")))
      {
         mkdir($path, 0777, true);
      }

      if(!file_exists($path = resource_path("/views/admin/" . strtolower(Str::plural($name)) . "/pages/")))
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
      // $type = $this->choice('What section do the permissions need to be added to?',
         // [0=>'Non-Core', 1=>'Core', 2=>'Module', ''=>'Select from above choices'], 2);

      DB::table('permissions')->insert([
         [
            // index permission
            'name' => strtolower(Str::plural($name)).'_browse',
            'display_name' => 'browse',
            'model' => strtolower($name),
            // 'type' => $type,
            'description' => 'List '.strtolower($name)
         ],
         [
            // show permission
            'name' => strtolower(Str::plural($name)).'_read',
            'display_name' => 'read',
            'model' => strtolower($name),
            // 'type' => $type,
            'description' => 'View '.strtolower($name)
         ],
         [
            // edit permission
            'name' => strtolower(Str::plural($name)).'_edit',
            'display_name' => 'edit',
            'model' => strtolower($name),
            // 'type' => $type,
            'description' => 'Edit '.strtolower($name)
         ],
         [
            // create permission
            'name' => strtolower(Str::plural($name)).'_add',
            'display_name' => 'add',
            'model' => strtolower($name),
            // 'type' => $type,
            'description' => 'Add '.strtolower($name)
         ],
         [
            // delete permission
            'name' => strtolower(Str::plural($name)).'_delete',
            'display_name' => 'delete',
            'model' => strtolower($name),
            // 'type' => $type,
            'description' => 'Delete '.strtolower($name)
         ]
      ]);

      // Find newly added permissions (ids)
      // $results = DB::select('select id from permissions where model = "' . strtolower($name) . '"');
      // Add permissions to admin account
      // foreach($results as $r) {
      //    DB::table('permission_user')->insert(
      //       [
      //          'permission_id' => $r->id,
      //          'user_id' => 2
      //       ]);
      // }
   }


   protected function addRoutes($name)
   {
      file_put_contents(
         base_path("routes/routes/" . strtolower(Str::plural($name)) . ".php"),
         $this->getTemplate('Routes', $name));
   }

}
