<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
   protected $guarded = [];

   protected $table = 'projects__materials';

//////////////////////////////////////////////////////////////////////////////////////
// ADD RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function projects()
   {
      return $this->belongsToMany('App\Models\Projects\Project::class', 'projects__material_project');
   }

}