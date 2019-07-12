<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $guarded = [];

   protected $table = 'projects-projects';

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
         4 => 'Furniture 4',
         5 => 'Furniture 5',
         6 => 'Furniture 6',
         7 => 'Furniture 7',
         8 => 'Furniture 8',
         9 => 'Furniture 9',
         10 => 'Furniture 10',
         11 => 'Furniture 11',
         12 => 'Furniture 12',
      ];
   }


//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function finishes()
   {
      return $this->belongsToMany(\App\Models\Projects\Finish::class, 'projects-finish_project');
   }

   public function materials()
   {
      return $this->belongsToMany(\App\Models\Projects\Material::class, 'projects-material_project');
   }

   public function images()
   {
      return $this->hasMany(\App\Models\Projects\Image::class);
   }
}