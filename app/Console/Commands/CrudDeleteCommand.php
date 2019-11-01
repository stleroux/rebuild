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


   public function handle()
   {
      // Get the name of the argument
      // $name = $this->ask('What is the name of the model to DELETE? (Must be Capitalized singular form: i.e.: User)');
      $name = $this->argument('name');

      if ($this->confirm('Are you sure you wish to delete ALL related files?')) {
 
         File::cleanDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         $this->info('╔════════════════════════════════════════════════════════════════════════════════╗');
         $this->info('║ Removing all files                                                             ║');
         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ - Admin controllers and folder deleted                                         ║');

         File::cleanDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         $this->info('║ - Frontend controllers and folder deleted                                      ║');

         File::delete(app_path('/Models/' . str_plural($name) . '/' . $name . '.php'));
         File::deleteDirectory(app_path('/Models/'. ucfirst(str_plural($name))));
         $this->info('║ - Model and folder deleted                                                     ║');

         File::delete(app_path('/Http/Requests/' . $name . 'Request.php'));
         $this->info('║ - Request file deleted                                                         ║');

         File::delete(app_path('/Providers/' . $name . 'ServiceProvider.php'));
         $this->info('║ - Service Provider file deleted                                                ║');

         File::cleanDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         $this->info('║ - Admin views and folder deleted                                               ║');

         File::cleanDirectory(resource_path('views/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/'. strtolower(str_plural($name))));
         $this->info('║ - Frontend views and folder deleted                                            ║');

         File::delete(resource_path('views/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         $this->info('║ - Frontend menu item deleted                                                   ║');
         File::delete(resource_path('views/admin/blocks/menu/menuItems/' . strtolower(str_plural($name)) . '.blade.php'));
         $this->info('║ - Admin menu item deleted                                                      ║');

         File::delete(glob(database_path("migrations\*".strtolower(str_plural($name))."_table.php")));
         $this->info('║ - Migration deleted                                                            ║');

         File::delete(base_path('/routes/routes/' . strtolower(str_plural($name) . '.php')));
         $this->info('║ - Routes file deleted                                                          ║');

         if($this->confirm('Do you wish to delete the database table also?')) {
            if($db = DB::getSchemaBuilder()->hasTable(strtolower(str_plural($name)))) {
               Schema::drop(strtolower(str_plural($name)));
               $this->info('║ - Database table deleted                                                       ║');
            }
         }

         $this->info('╠════════════════════════════════════════════════════════════════════════════════╣');
         $this->info('║ All files removed successfully                                                 ║');
         $this->info('╚════════════════════════════════════════════════════════════════════════════════╝');
      }
   }

}
