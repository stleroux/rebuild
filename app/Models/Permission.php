<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

   protected $cast = [
      'type' => 'boolean',
   ];

   public function users()
   {
      return $this->beongsToMany('App\Models\User');
   }
}
