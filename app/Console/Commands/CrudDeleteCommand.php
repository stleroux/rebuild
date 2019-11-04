<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;
use DB;
use Schema;

// class CrudGeneratorCommand extends Command
class CrudDeleteCommand extends Command
{

   // protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';
   // protected $signature = 'crud:generator';
   protected $signature = 'crud:delete {name}';

   protected $description = 'Delete CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }


// Delete entries from migration table


   public function handle()
   {
      // Get the name of the argument
      // $name = $this->ask('What is the name of the model to DELETE? (Must be Capitalized singular form: i.e.: User)');
      $name = $this->argument('name');

      if ($this->confirm('Are you sure you wish to delete ALL related files?')) {
 
         $this->info('╔════════════════════════════════════════════════════════════════════════════════╗');
         $this->info('║ Removing all files                                                             ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete admin controllers and folder
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::cleanDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         $this->info('║ - Admin controllers and folder deleted                                         ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete frontend controllers and folder
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::cleanDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         $this->info('║ - Frontend controllers and folder deleted                                      ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete model and folder
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(app_path('/Models/' . str_plural($name) . '/' . $name . '.php'));
         File::deleteDirectory(app_path('/Models/'. ucfirst(str_plural($name))));
         $this->info('║ - Model and folder deleted                                                     ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete request
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(app_path('/Http/Requests/' . $name . 'Request.php'));
         $this->info('║ - Request file deleted                                                         ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete service provider
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(app_path('/Providers/' . $name . 'ServiceProvider.php'));
         $this->info('║ - Service Provider file deleted                                                ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete admin views and folders
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::cleanDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         $this->info('║ - Admin views and folder deleted                                               ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete frontend views and folders
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::cleanDirectory(resource_path('views/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/'. strtolower(str_plural($name))));
         $this->info('║ - Frontend views and folder deleted                                            ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete menu items
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(resource_path('views/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         $this->info('║ - Frontend menu item deleted                                                   ║');
         File::delete(resource_path('views/admin/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         $this->info('║ - Admin menu item deleted                                                      ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete migration file
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(glob(database_path("migrations/*_create_" . strtolower(str_plural($name)) . "_table.php")));
         $this->info('║ - Migration deleted                                                            ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete routes file
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         File::delete(base_path('/routes/routes/' . strtolower(str_plural($name) . '.php')));
         $this->info('║ - Routes file deleted                                                          ║');

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Remove include line to homepage blocks
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         if(strpos(file_get_contents(resource_path("/views/homepage/blocks.blade.php")), '@include(\'' . strtolower(Str::plural($name)) . ".blocks.popular'") !== false) {
            $content = file_get_contents(resource_path("/views/homepage/blocks.blade.php"));
            $content = str_replace("@include('tests.blocks.popular')\n", "", $content);
            file_put_contents(resource_path("/views/homepage/blocks.blade.php"), $content);
            $this->info('║ - Removed include line from block.blade.php                                    ║');
         }

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Un-register service provider in config/app.php
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // dd(strtolower(str::plural($name)));
         if(strpos(file_get_contents(base_path("config/app.php")), 'App\Providers' . '\\' . $name . 'ServiceProvider::class,') !== false) {
            $content = file_get_contents(base_path("config/app.php"));
            $content = str_replace("App\Providers". "\\" . $name . "ServiceProvider::class,\n", "", $content);
            file_put_contents(base_path("config/app.php"), $content);
            $this->info('║ - Removed Service Provider line from config/app.php                            ║');
         }

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Remove icon line from config/buttons.php
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $val = "'" . strtolower(str::plural($name)) . "' => 'fas fa-fw fa-random',\n";
         if(strpos(file_get_contents(base_path("config/buttons.php")), $val) !== false) {
            $content = file_get_contents(base_path("config/buttons.php"));
            $content = str_replace($val, "", $content);
            file_put_contents(base_path("config/buttons.php"), $content);
            $this->info('║ - Removed Icon line form config/buttons.php                                    ║');
         }

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete permissions
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         if($this->confirm('Do you wish to delete the entries from the permissions table?')) {
            // Find the permissions (ids)
            $results = DB::select('select id from permissions where model = "' . strtolower($name) . '"');
            // Delete permissions froom Permissions table
            foreach($results as $r) {
               DB::table('permissions')->where('model', '=', strtolower($name))->delete();
            }
            $this->info('║ - Entries deleted from permissions table                                       ║');
         }

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete Database table
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         if($this->confirm('Do you wish to delete the database table?')) {
            if($db = DB::getSchemaBuilder()->hasTable(strtolower(str_plural($name)))) {
               Schema::drop(strtolower(str_plural($name)));
               $this->info('║ - Database table deleted                                                       ║');
            }
         }

         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ All files removed successfully                                                 ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ NEXT STEPS:                                                                    ║');
         $this->info('║   - Remove entries from Migrations table                                       ║');
         $this->info('║   -                                                                            ║');
         $this->info('║                                                                                ║');
         $this->info('║   -                                                                            ║');
         $this->info('║                                                                                ║');
         $this->info('║                                                                                ║');
         $this->info('║   - Do not forget to run "composer dump-autoload                               ║');
         $this->info('╚════════════════════════════════════════════════════════════════════════════════╝');
      }
   }
}