<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
   protected $guarded = [];

   protected $table = 'projects__finishes';

// Set the default value for the sheen field to 0
   protected $attributes = [
      'sheen' => 0,
   ];

   public function getSheenAttribute($attribute)
   {
      return $this->sheenOptions()[$attribute];
   }

   public function sheenOptions()
   {
      return [
         0 => 'Select',
         1 => 'Low Luster',
         2 => 'Satin',
         3 => 'Semi-gloss',
         4 => 'Gloss',
      ];
   }

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function projects()
   {
      return $this->belongsToMany('App\Models\Projects\Project::class', 'projects__finish_project');
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