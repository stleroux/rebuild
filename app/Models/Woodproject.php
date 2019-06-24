<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Woodproject extends Model
{
   protected $guarded = [];


   // Set the default value for the status field to 0
   // protected $attributes = [
   //    'category' => 0,
   // ];


   // public function getCategoryAttribute($attribute)
   // {
   //    return $this->categoriesOptions()[$attribute];
   // }


   // public function categoriesOptions()
   // {
   //    return [
   //       0 => 'Select One',
   //       1 => 'General',
   //       2 => 'Furniture',
   //    ];
   // }

   public function category()
   {
      return $this->belongsTo('App\Models\Category');
   }

}