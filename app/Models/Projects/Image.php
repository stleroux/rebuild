<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $guarded = [];

   protected $table = 'projects-images';

//////////////////////////////////////////////////////////////////////////////////////
// ADD RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function projects()
   {
      return $this->belongsTo(\App\Models\Projects\Project::class, 'projects-projects');
   }

}
