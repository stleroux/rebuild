<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $guarded = [];

   protected $table = 'projects-images';

   public function projects()
   {
   //    // return $this->belongsTo(App\Models\Projects\Project::class);
      return $this->belongsTo(\App\Models\Projects\Project::class, 'projects-projects');
   //    return $this->belongsToMany('App\Models\Projects\Project::class', 'projects-image_project');
   }

}
