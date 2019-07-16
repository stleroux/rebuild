<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $guarded = [];

   protected $table = 'projects__projects';

   // Set the default value for the status field to 0
   protected $attributes = [
      'category' => 0,
   ];

   public function getCategoryAttribute($attribute)
   {
      return $this->categoriesOptions()[$attribute];
   }

   public function categoriesOptions()
   {
      return [
         0 => 'Select One',
         1 => 'General',
         2 => 'Furniture',
         3 => 'Kitchen appliance',
      ];
   }


//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function finishes()
   {
      return $this->belongsToMany(\App\Models\Projects\Finish::class, 'projects__finish_project');
   }

   public function materials()
   {
      return $this->belongsToMany(\App\Models\Projects\Material::class, 'projects__material_project');
   }

   public function images()
   {
      return $this->hasMany(\App\Models\Projects\Image::class);
   }
}