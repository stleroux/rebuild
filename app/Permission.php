<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

   protected $cast = [
      'core' => 'boolean',
   ];

   public function users()
   {
      return $this->beongsToMany('App\User');
   }
}
