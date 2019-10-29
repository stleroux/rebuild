<?php

namespace App\Models\Tests;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
   protected $guarded = [];


   // Set the default value for the status field to 0
   protected $attributes = [
      'status' => 0,
   ];


   public function getStatusAttribute($attribute)
   {
      return $this->statusOptions()[$attribute];
   }


   public function statusOptions()
   {
      return [
         1 => 'Active',
         0 => 'Inactive',
         2 => 'In-Progress',
      ];
   }


}