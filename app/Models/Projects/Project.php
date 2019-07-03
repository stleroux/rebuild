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
      ];
   }

//////////////////////////////////////////////////////////////////////////////////////
// ADD RELATIONSHIPS
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