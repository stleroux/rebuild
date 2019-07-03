<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
   protected $guarded = [];

   protected $table = 'projects-materials';

   public function projects()
   {
      // return $this->belongsToMany(App\Models\Projects\Project::class);
      // return $this->belongsToMany(\App\Models\Projects\Project::class, 'projects-material_project');
      return $this->belongsToMany('App\Models\Projects\Project::class', 'projects-material_project');
   }

}