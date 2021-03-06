<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
   // use SoftDeletes;

   protected $fillable = ['first_name'];

   protected $cast = [
      'public_email' => 'boolean',
   ];

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
	// public function user() { 
	// 	return $this->belongsTo('App\Models\User');
	// }

 //   public function landingPage () {
 //      return $this->belongsTo(Category::class);
 //   }

   // public function scopeTrashed($query)
   // {
   //    return $query->where('deleted_at', '!=', NULL)->withTrashed();
   // }

   public function getCreatedAtAttribute($date)
   {
      $date = new \Carbon\Carbon($date);
      // Now modify and return the date
      $date = $date->format('M d, Y');
      return $date;
   }
}
