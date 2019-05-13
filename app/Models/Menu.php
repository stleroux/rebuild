<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class menu extends Model
{
   protected $table = 'menus';
 
    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }
 
    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }
}