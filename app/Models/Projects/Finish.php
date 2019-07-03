<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
   protected $guarded = [];

   protected $table = 'projects-finishes';

   public function projects()
   {
      // return $this->belongsToMany(App\Models\Projects\Project::class);
      return $this->belongsToMany('App\Models\Projects\Project::class', 'projects-finish_project');
   }
}