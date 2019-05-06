<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{

	protected $fillable = [];

	public function commentable()
	{
		return $this->morphTo();
	}

	public function post()
	{
		return $this->belongsTo('Modules\Posts\Entities\Post');
	}

   public function user()
   {
      return $this->belongsTo('App\Models\User');
   }

	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

	// public function scopeNewComments($query)
 //   	{
 //    	return $query
 //        	->where('created_at', '>=' , Auth::user()->last_login_date)
 //        	//->where('user_id', '=', Auth::user()->id)
 //        	//->orderBy('title','DESC')
 //        	;
 //   }
}
