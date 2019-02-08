<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
//use OwenIt\Auditing\Auditable;
//use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

//class Tag extends Model implements AuditableContract
class Tag extends Model
{
	//use Auditable;
	
	protected $fillable = ['name'];
	
	public function posts()
	{
		return $this->belongsToMany('Modules\Posts\Entities\Post');
		// return $this->belongsToMany('App\Post', 'nameOfTable (post_tag)', 'this model id', 'foreign model id');
	}

   // public function scopeNewTags($query)
   // {
   //    return $query
   //       ->where('created_at', '>=' , Auth::user()->last_login_date)
   //       //->where('user_id', '=', Auth::user()->id)
   //       ->orderBy('name','DESC');
   // }
}