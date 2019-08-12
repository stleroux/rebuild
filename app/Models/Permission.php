<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

   protected $cast = [
      'type' => 'boolean',
   ];

   // Set the default value for the status field to 0
   protected $attributes = [
      'type' => 0,
   ];

   public function getTypeAttribute($attribute)
   {
      return $this->typesOptions()[$attribute];
   }

   public function typesOptions()
   {
      return [
         0 => 'Select One',
         1 => 'Non-Core',
         2 => 'Core',
         3 => 'Module',
      ];
      // Also update the Create and Edit methods in the UsersController if needed
   }

}
