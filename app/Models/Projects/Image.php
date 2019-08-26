<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $guarded = [];

   protected $table = 'projects__images';

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function projects()
   {
      return $this->belongsTo(\App\Models\Projects\Project::class, 'projects__projects');
   }

}
