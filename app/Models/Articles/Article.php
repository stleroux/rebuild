<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\Models\Category;
use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;


class Article extends Model
	// implements AuditableContract
{
	use SoftDeletes;
   use Favoriteable;

   protected $guarded = [];
   
	protected $dates = ['deleted_at', 'published_at'];

	// protected $fillable = [
	// 	'title',
	// 	'category_id',
	// 	'published_at',
	// 	'description_eng',
	// 	'description_fre',
	// 	'user_id'
	// ];




   // Set the default value for the status field to 0
   protected $attributes = [
      'category' => 0,
   ];

   public function getCategoryAttribute($attribute)
   {
      return $this->categoriesOptions()[$attribute];
   }

   public function categoriesOptions()
   {
      return [
         0 => 'Select One',
         1 => 'Sites',
         2 => 'General',
         3 => 'Blog',
         4 => 'Recipe',
         5 => 'Project',
      ];
   }




//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   // public function parent() {
   //    return $this->belongsTo(self::class, 'parent_id')->orderBy('name');
   // }

   // public function children() {
   //    return $this->hasMany(self::class, 'parent_id')->orderBy('name');
   // }

	public function comments()
	{
		return $this->morphMany('\App\Models\Comment', 'commentable')->orderBy('id','desc');
	}
	
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	// public function category()
	// {
	// 	return $this->belongsTo('App\Models\Category');
	// }

	// Used to display the Add/Remove links if item is in favorite list
	// public function favorites()
	// {
	// 	return $this->belongsToMany('App\Models\User')->where('user_id','=',Auth::user()->id);
	// }

//////////////////////////////////////////////////////////////////////////////////////
// SCOPES
//////////////////////////////////////////////////////////////////////////////////////
	public function scopePublished($query)
	{
		return $query->where('published_at', '<', Carbon::now());
	}

	public function scopeMyArticles($query)
	{
		return $query->where('user_id', '=', Auth::user()->id)->orderBy('title','DESC');
	}

	public function scopeUnpublished($query)
	{
		return $query->whereNull('published_at');
	}

	public function scopeFuture($query)
	{
		return $query->where('published_at', '>', Carbon::Now());
	}
	
	public function scopeTrashed($query)
	{
		return $query->whereNotNull('deleted_at')->withTrashed();
	}

	public function scopeTrashedCount($query)
	{
		return $query->whereNotNull('deleted_at')->withTrashed();
	}

   public function scopeNewArticles($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->previous_login_date)
         ->orderBy('title','DESC');
   }

	// public function scopeMyFavorites($query)
	// {
	// 	return $query->whereHas('user', function($q) 
	// 	{
	// 		$q->where('user_id', '=', Auth::user()->id);
	// 		dd($q);
	// 	})->get();
	// 	return $query->wherePivot('article_user', Auth::user()->id);
	// }


//////////////////////////////////////////////////////////////////////////////////////
// ACCESSORS
//////////////////////////////////////////////////////////////////////////////////////
   public function getCreatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      return 'N/A';
   }

   public function getUpdatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      return 'N/A';
   }


}
