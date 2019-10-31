<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

// class CrudGeneratorCommand extends Command
class CrudDeleteCommand extends Command
{

   // protected $signature = 'crud:generator {name : Class (singular), e.g.: User}';
   // protected $signature = 'crud:generator';
   protected $signature = 'crud:delete';

   protected $description = 'Delete CRUD operations';

   public function __construct()
   {
      parent::__construct();
   }


   public function handle()
   {
      // Get the name of the argument
      $name = $this->ask('What is the name of the model to DELETE? (Must be Capitalized singular form: i.e.: User)');

      if ($this->confirm('Are you sure you wish to delete ALL related files?')) {
 
         File::cleanDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/Admin/'. str_plural($name)));
         $this->info('Admin controllers and folder deleted');

         File::cleanDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         File::deleteDirectory(app_path('/Http/Controllers/'. str_plural($name)));
         $this->info('Frontend controllers and folder deleted');

         File::delete(app_path('/Models/' . str_plural($name) . '/' . $name . '.php'));
         File::deleteDirectory(app_path('/Models/'. ucfirst(str_plural($name))));
         $this->info('Model and folder deleted');

         File::delete(app_path('/Http/Requests/' . $name . 'Request.php'));
         $this->info('Request file deleted');

         File::delete(app_path('/Providers/' . $name . 'ServiceProvider.php'));
         $this->info('Service Provider file deleted');

         File::cleanDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/admin/'. strtolower(str_plural($name))));
         $this->info('Admin views and folder deleted');

         File::cleanDirectory(resource_path('views/'. strtolower(str_plural($name))));
         File::deleteDirectory(resource_path('views/'. strtolower(str_plural($name))));
         $this->info('Frontend views and folder deleted');

         File::delete(base_path('/routes/routes/' . strtolower(str_plural($name) . '.php')));
         $this->info('Routes file deleted');
      }
   }

}
