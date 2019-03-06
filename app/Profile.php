<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
   // use SoftDeletes;

   protected $fillable = ['first_name'];

   protected $cast = [
      'public_email' => 'boolean',
   ];

	public function user() { 
		return $this->belongsTo('App\User');
	}

   public function landingPage () {
      return $this->belongsTo(Category::class);
   }

   // public function scopeTrashed($query)
   // {
   //    return $query->where('deleted_at', '!=', NULL)->withTrashed();
   // }
}
