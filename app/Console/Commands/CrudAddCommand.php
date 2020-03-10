<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;
use DB;

class CrudAddCommand extends Command
{

   // protected $signature = 'crud:add {name? : Class e.g.: User}';
   protected $signature = 'crud:add';

   protected $description = 'Create CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }

   public function handle()
   {
      // Get the name of the argument
      $name = $this->ask('What is the name of the model? (Must be singular form: i.e.: user)');
      // $name = ucfirst($this->argument('name'));
      $name = ucfirst($name);

      
      if ($this->confirm('Are you sure you want to proceed?', false)) {

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // QUESTIONS
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Ask if model needs to be publically available or if login is required to view ????
         $addPermissionsToDB = $this->confirm('Do you wish to add base PERMISSIONS to the database?', false);
         $migrateData = $this->confirm('Do you want to migrate the new migration?', true);
         $createSeeder = $this->confirm('Do you want to create a Seeder file?', true);
         $populateDB = $this->confirm('Do you want to populate the database table with sample records?', true);

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // ACTIONS
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $this->addItemToMenuBlock($name);
         $this->addIconToButtonsFile($name);
         $this->addServiceProviderToAppFile($name);

         $this->createFrontendFolders($name);
         $this->createAdminFolders($name);
         $this->frontendControllers($name);
         $this->adminControllers($name);
         $this->model($name);
         $this->addFrontendViews($name);
         $this->addFrontendButtons($name);
         $this->addFrontendBlocks($name);
         $this->addFrontendExtraPages($name);
         $this->addFrontendMenuItem($name);
         $this->addAdminViews($name);
         $this->addAdminButtons($name);
         $this->addAdminBlocks($name);
         $this->addAdminExtraPages($name);
         $this->addAdminMenuItem($name);
         $this->request($name);
         $this->serviceProvider($name);
         if ($addPermissionsToDB) {
            $this->addPermissions($name);
         }
         $this->addRoutes($name);
         $this->makeMigration($name);
         if($migrateData) {
            \Artisan::call('migrate');
         }
         if($createSeeder) {
            $this->makeSeeder($name);
            if($populateDB) {
               // system('composer dump-autoload');
               \Artisan::call('db:seed --class="' . str::plural($name) . 'TableSeeder"');
            }
         }

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // INFORMATION
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $this->info('╔═════════════════════════════════════════════════════════════════════════════════════════╗');
         $this->info('║ Generating your code                                                                    ║');
         $this->info('╠═════════════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ - Frontend folders created                                                              ║');
         $this->info('║ - Admin folders created                                                                 ║');
         $this->info('║ - Frontend controllers created                                                          ║');
         $this->info('║ - Admin controllers created                                                             ║');
         $this->info('║ - Model created                                                                         ║');
         $this->info('║ - Frontend views created                                                                ║');
         $this->info('║ - Frontend buttons added                                                                ║');
         $this->info('║ - Frontend blocks added                                                                 ║');
         $this->info('║ - Frontend extra pages added                                                            ║');
         $this->info('║ - Frontend menu item added                                                              ║');
         $this->info('║ - Admin views created                                                                   ║');
         $this->info('║ - Admin buttons added                                                                   ║');
         $this->info('║ - Admin blocks added                                                                    ║');
         $this->info('║ - Admin extra pages added                                                               ║');
         $this->info('║ - Admin menu item added                                                                 ║');
         $this->info('║ - Request created                                                                       ║');
         $this->info('║ - Request created                                                                       ║');
         if ($addPermissionsToDB) {
            $this->info('║ - Base permissions added to database                                                    ║');
         }
         $this->info('║ - Route resource added to web.php routes file                                           ║');
         $this->info('║ - Migration file created                                                                ║');
         if($migrateData) {
            $this->info('║ - Database table created                                                                ║');
         }
         if($createSeeder) {
            $this->makeSeeder($name);
            $this->info('║ - Seeder file created                                                                   ║');
            if($populateDB) {
               \Artisan::call('db:seed --class="' . str::plural($name) . 'TableSeeder"');
               $this->info('║ - Database table updated with sample records                                            ║');
            }
         }
         $this->info('║                                                                                         ║');
         $this->info('╠═════════════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ Done generating files! Happy coding.                                                    ║');
         $this->info('╠═════════════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ NEXT STEPS:                                                                             ║');
         $this->info('║   - Update the migration file                                                           ║');
         $this->info('║   - Update the form for the Edit and Create page                                        ║');
         $this->info('║                                                                                         ║');
         $this->info('║ - Add the ServiceProvider class to config\app.php                                       ║');
         $this->info('║                                                                                         ║');
         $this->info('║                                                                                         ║');
         $this->info('║ - Do not forget to :                                                                    ║');
         $this->info('║   - run "php artisan migrate" if you haven\'t already migrated and seeded the database   ║');
         $this->info('║                                                                                         ║');
         $this->info('╚═════════════════════════════════════════════════════════════════════════════════════════╝');
      }
   }


   protected function addItemToMenuBlock($name)
   {
      File::append(
         resource_path('views/homepage/blocks.blade.php'),
         '@include(\'' . strtolower(Str::plural($name)) . ".blocks.popular')\n");
   }


   protected function addIconToButtonsFile($name)
   {
      $val = "'" . strtolower(str::plural($name)) . "' => 'fab fa-fw fa-laravel',\n";
      $configFile = base_path().'/config/buttons.php';
      $file = file_get_contents($configFile);
      $searchFor = '/** CRUD Added **/'.PHP_EOL;
      $customIcon = strpos($file, $searchFor);
      if($customIcon) {
         // \t represents a tab
         $newFile = substr_replace($file, $searchFor."\t".$val.PHP_EOL, $customIcon, strlen($searchFor));
         // Save file
         file_put_contents($configFile, $newFile);
      }
   }


   protected function addServiceProviderToAppFile($name) {
      $configFile = base_path().'/config/app.php';
      $file = file_get_contents($configFile);
      $searchFor = '/* * Customer Service Providers */'.PHP_EOL;
      $customProviders = strpos($file, $searchFor);
      if($customProviders) {
         $namespace = "App";
         $moduleName = "Providers";
         // $name = Str::plural($name);
         $newFile = substr_replace($file, $searchFor."\t\t".$namespace.'\\'.$moduleName.'\\'.$name.'ServiceProvider::class,'.PHP_EOL, $customProviders, strlen($searchFor));
         // Save file
         file_put_contents($configFile, $newFile);
      }
   }


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
         app_path("/Http/Requests/".$name."Request.php"),
         $this->getTemplate('Request', $name));
   }


   protected function serviceProvider($name)
   {
      file_put_contents(
         app_path("/Providers/".$name."ServiceProvider.php"),
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
         resource_path("/views/admin/".strtolower(Str::plural($name))."/form.blade.php"),
         $this->getTemplate('admin/views/form', $name)
      );

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
         resource_path("/views/admin/".strtolower(Str::plural($name))."/trash.blade.php"),
         $this->getTemplate('admin/views/trash', $name));
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
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/back.blade.php"),
         $this->getTemplate('frontend/buttons/back', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/btnFavorite.blade.php"),
         $this->getTemplate('frontend/buttons/btnFavorite', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/favorite.blade.php"),
         $this->getTemplate('frontend/buttons/favorite', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/help.blade.php"),
         $this->getTemplate('frontend/buttons/help', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/myFavorites.blade.php"),
         $this->getTemplate('frontend/buttons/myFavorites', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/next.blade.php"),
         $this->getTemplate('frontend/buttons/next', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/nextAll.blade.php"),
         $this->getTemplate('frontend/buttons/nextAll', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/previous.blade.php"),
         $this->getTemplate('frontend/buttons/previous', $name)
      );

      file_put_contents(
         resource_path("/views/".strtolower(Str::plural($name))."/buttons/previousAll.blade.php"),
         $this->getTemplate('frontend/buttons/previousAll', $name)
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
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/btn_delete.blade.php"),
         $this->getTemplate('admin/buttons/btn_delete', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/btn_trash.blade.php"),
         $this->getTemplate('admin/buttons/btn_trash', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/delete.blade.php"),
         $this->getTemplate('admin/buttons/delete', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/deleteAll.blade.php"),
         $this->getTemplate('admin/buttons/deleteAll', $name)
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
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/restore.blade.php"),
         $this->getTemplate('admin/buttons/restore', $name)
      );

      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/buttons/restoreAll.blade.php"),
         $this->getTemplate('admin/buttons/restoreAll', $name)
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


   protected function addFrontendExtraPages($name)
   {
      file_put_contents(
         resource_path("views/".strtolower(Str::plural($name))."/archives.blade.php"),
         $this->getTemplate('frontend/pages/archives', $name));

      file_put_contents(
         resource_path("views/".strtolower(Str::plural($name))."/myFavorites.blade.php"),
         $this->getTemplate('frontend/pages/myFavorites', $name));
   }


   protected function addAdminExtraPages($name)
   {
      file_put_contents(
         resource_path("/views/admin/".strtolower(Str::plural($name))."/pages/archives.blade.php"),
         $this->getTemplate('admin/pages/archives', $name));

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


   protected function makeSeeder($name)
   {
      file_put_contents(
         database_path("/seeds/" . Str::plural($name) . "TableSeeder.php"),
         $this->getTemplate('Seeder', $name)
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
      DB::table('permissions')->insert([
         [
            // Browse permission (Index)
            'name' => strtolower($name).'_browse',
            'display_name' => 'browse',
            'model' => strtolower($name),
            'description' => 'List '.strtolower($name)
         ],
         [
            // Read permission (Show)
            'name' => strtolower($name).'_read',
            'display_name' => 'read',
            'model' => strtolower($name),
            'description' => 'View '.strtolower($name)
         ],
         [
            // Edit permission
            'name' => strtolower($name).'_edit',
            'display_name' => 'edit',
            'model' => strtolower($name),
            'description' => 'Edit '.strtolower($name)
         ],
         [
            // Add permission (Create)
            'name' => strtolower($name).'_add',
            'display_name' => 'add',
            'model' => strtolower($name),
            'description' => 'Add '.strtolower($name)
         ],
         [
            // Delete permission
            'name' => strtolower($name).'_delete',
            'display_name' => 'delete',
            'model' => strtolower($name),
            'description' => 'Delete '.strtolower($name)
         ]
      ]);
   }


   protected function addRoutes($name)
   {
      file_put_contents(
         base_path("routes/routes/" . strtolower(Str::plural($name)) . ".php"),
         $this->getTemplate('Routes', $name));
   }

}
