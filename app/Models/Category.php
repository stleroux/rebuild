<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use OwenIt\Auditing\Auditable;
//use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Auth;

class Category extends Model //implements AuditableContract
{
	use SoftDeletes;
	//use Auditable;

	protected $dates = ['deleted_at', 'created_at', 'updated_at'];
	
	// Manually tell the model which table to use
	// Not needed if you call the table Categories (following the conventions)
	protected $table = 'categories';

	// protected $guarded = ['id'];

	public function parent() {
		return $this->belongsTo(self::class, 'parent_id')->orderBy('name');
	}

	public function children() {
		return $this->hasMany(self::class, 'parent_id')->orderBy('name');
	}

	/**
	* Always capitalize the name when we retrieve it
	*/
	// public function getNameAttribute($value) {
	// 	return ucfirst($value);
	// }

	// 1 category has many posts
	// a related entry needs to be added to the post model
	public function posts()
	{
		return $this->hasMany('App\Models\Post');
	}

	// 1 category belongsToMany recipes
	// a related entry needs to be added to the post model
	public function recipes()
	{
		return $this->hasMany('App\Models\Recipe');
	}

	// public function module()
	// {
	// 	return $this->belongsTo('App\Module')->orderBy('name','desc');
	// }

	public function projects()
	{
		return $this->hasMany('App\Models\Project');
	}

	// public function scopeNewCategories($query)
 //   {
 //      return $query
 //         ->where('created_at', '>=' , Auth::user()->last_login_date)
 //         //->where('user_id', '=', Auth::user()->id)
 //         ->orderBy('name','DESC');
 //   }

}