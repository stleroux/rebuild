<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   protected $guarded = [];

   protected $table = 'projects__projects';

   protected $dates = ['completed_at'];

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
         1 => 'Decoration',
         2 => 'Furniture',
         3 => 'General',
         4 => 'Storage',
         5 => 'Wall Hanging',
         1000 => 'Lastest 4',
      ];
   }


//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   // public function category()
   // {
   //    return $this->hasOne(\App\Models\Category::class);
   // }

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

   public function comments()
   {
      return $this->morphMany('\App\Models\Comment', 'commentable')->orderBy('id','desc');
   }


//////////////////////////////////////////////////////////////////////////////////////
// ACCESSORS
//////////////////////////////////////////////////////////////////////////////////////
   public function getCreatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }

   public function getUpdatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }


}
