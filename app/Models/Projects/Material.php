<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
   protected $guarded = [];

   protected $table = 'projects__materials';

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function projects()
   {
      return $this->belongsToMany('App\Models\Projects\Project::class', 'projects__material_project');
   }


//////////////////////////////////////////////////////////////////////////////////////
// ACCESSORS
//////////////////////////////////////////////////////////////////////////////////////
   public function getCreatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         // Now modify and return the date
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }

   public function getUpdatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         // Now modify and return the date
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      // return 'N/A';
   }

}
