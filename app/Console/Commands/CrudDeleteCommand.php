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

   // protected $signature = 'crud:delete {name : Class e.g.: User}';
   protected $signature = 'crud:delete';

   protected $description = 'Delete CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }



// homepage/blocks.blade.php - entry not being removed



   public function handle()
   {
      // Get the name of the argument
      // $name = $this->ask('What is the name of the model to DELETE? (Must be Capitalized singular form: i.e.: User)');
      // $name = ucfirst($this->argument('name'));
      // Get the name of the argument
      $name = $this->ask('What is the name of the model? (Must be singular form: i.e.: user)');
      // $name = ucfirst($this->argument('name'));
      $name = ucfirst($name);

      if ($this->confirm('Are you sure you wish to delete ALL related files?')) {

         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // QUESTIONS
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $deletePermissions = $this->confirm('Do you wish to delete the entries from the permissions table?', true);
         $deleteDBTable = $this->confirm('Do you wish to delete the database table?', true);


         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // ACTIONS
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // Delete admin controllers and folder
         File::cleanDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));

         // Delete frontend controllers and folder
         File::cleanDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         
         // Delete model and folder
         File::delete(app_path('/Models/' . str_plural($name) . '/' . $name . '.php'));
         File::deleteDirectory(app_path('/Models/'. ucfirst(str_plural($name))));
         
         // Delete request
         File::delete(app_path('/Http/Requests/' . $name . 'Request.php'));
         
         // Delete service provider
         File::delete(app_path('/Providers/' . $name . 'ServiceProvider.php'));
         
         // Delete admin views and folders
         File::cleanDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         
         // Delete frontend views and folders
         File::cleanDirectory(resource_path('views/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/'. strtolower(str_plural($name))));
         
         // Delete menu items
         File::delete(resource_path('views/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         File::delete(resource_path('views/admin/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         
         // Delete migration file
         File::delete(glob(database_path("migrations/*_create_" . strtolower(str_plural($name)) . "_table.php")));
         
         // Delete routes file
         File::delete(base_path('/routes/routes/' . strtolower(str_plural($name) . '.php')));
         
         // Delete seeder file
         File::delete(database_path('/seeds/' . str_plural($name) . 'TableSeeder.php'));
         
         // Remove include line to homepage blocks
         if(strpos(file_get_contents(resource_path("/views/homepage/blocks.blade.php")), '@include(\'' . strtolower(Str::plural($name)) . ".blocks.popular'") !== false) {
            $content = file_get_contents(resource_path("/views/homepage/blocks.blade.php"));
            $content = str_replace("@include('".strtolower(Str::plural($name)).".blocks.popular')\n", "", $content);
            file_put_contents(resource_path("/views/homepage/blocks.blade.php"), $content);
         }

         // Remove icon line from config/buttons.php
         $val = "'" . strtolower(str::plural($name)) . "' => 'fas fa-fw fa-random',\n";
         if(strpos(file_get_contents(base_path("config/buttons.php")), $val) !== false) {
            $content = file_get_contents(base_path("config/buttons.php"));
            $content = str_replace($val, "", $content);
            file_put_contents(base_path("config/buttons.php"), $content);
         }
         
         // Un-register service provider in config/app.php
         $val = "\t\t" . "App\Providers" . "\\" . $name . "ServiceProvider::class,".PHP_EOL."";
         if(strpos(file_get_contents(base_path("config/app.php")), $val) !== false) {
            $content = file_get_contents(base_path("config/app.php"));
            $content = str_replace($val, "", $content);
            file_put_contents(base_path("config/app.php"), $content);
         }

         // Delete permissions
         if($deletePermissions) {
            // Find the permissions (ids)
            $results = DB::select('select id from permissions where model = "' . strtolower($name) . '"');
            // Delete permissions froom Permissions table
            foreach($results as $r) {
               DB::table('permissions')->where('model', '=', strtolower($name))->delete();
            }
         }

         // Delete Database table
         if($deleteDBTable) {
            if($db = DB::getSchemaBuilder()->hasTable(strtolower(str_plural($name)))) {
               Schema::drop(strtolower(str_plural($name)));
            }
         }


         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         // INFORMATION
         ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $this->info('╔════════════════════════════════════════════════════════════════════════════════╗');
         $this->info('║ Removing all files                                                             ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ - Admin controllers and folder deleted                                         ║');
         $this->info('║ - Frontend controllers and folder deleted                                      ║');
         $this->info('║ - Model and folder deleted                                                     ║');
         $this->info('║ - Request file deleted                                                         ║');
         $this->info('║ - Service Provider file deleted                                                ║');
         $this->info('║ - Admin views and folder deleted                                               ║');
         $this->info('║ - Frontend views and folder deleted                                            ║');
         $this->info('║ - Frontend menu item deleted                                                   ║');
         $this->info('║ - Admin menu item deleted                                                      ║');
         $this->info('║ - Migration deleted                                                            ║');
         $this->info('║ - Routes file deleted                                                          ║');
         $this->info('║ - Seeder file deleted                                                          ║');
         $this->info('║ - Removed include line from block.blade.php                                    ║');
         $this->info('║ - Removed Icon line form config/buttons.php                                    ║');
         $this->info('║ - Removed Service Provider line from config/app.php                            ║');
         if($deletePermissions){
            $this->info('║ - Entries deleted from permissions table                                       ║');
         }
         if($deleteDBTable) {
            $this->info('║ - Database table deleted                                                       ║');
         }
         $this->info('║                                                                                ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ All files removed successfully                                                 ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ NEXT STEPS:                                                                    ║');
         $this->info('║   - Remove entry from Migrations table                                         ║');
         $this->info('║   - Remove Seeder file (if needed)                                             ║');
         $this->info('║   -                                                                            ║');
         $this->info('║   -                                                                            ║');
         $this->info('║                                                                                ║');
         $this->info('║                                                                                ║');
         $this->info('║   - Do not forget to run "composer dump-autoload                               ║');
         $this->info('╚════════════════════════════════════════════════════════════════════════════════╝');
      }
   }
}