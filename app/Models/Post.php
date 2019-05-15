<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon\Carbon;

class Post extends Model
{

   use SoftDeletes;

   protected $fillable = ['slug'];

   protected $dates = ['deleted_at', 'published_at'];

   
   protected static function boot()
   {
      parent::boot();

      // Once post is created, add the slug
      static::created(function ($post) {
         $post->update(['slug' => $post->title]);
      });
   }

   public function setSlugAttribute($value)
   {
      // if slug already exists, add a dash and the id of the post to make the slug unique
      if (static::whereSlug($slug = str_slug($value))->exists()) {
         $slug = "{$slug}-{$this->id}";
      }
      $this->attributes['slug'] = $slug;
   }
   
// 1 category belongs to many posts
   // a related entry needs to be added to the category model
   public function category()
   {
      return $this->belongsTo('App\Models\Category');
   }

   public function tags()
   {
      return $this->belongsToMany('App\Models\Tag')->orderBy('name','asc');
   }

   public function comments()
   {
      return $this->morphMany('\App\Models\Comment', 'commentable')->orderBy('id','desc');
   }

   public function user()
   {
      return $this->belongsTo('App\Models\User');
   }

   public function updated_by()
   {
      return $this->belongsTo('App\Models\User');
   }

   public function scopeBlog($query)
   {
      return $query
         ->where('category','=',2);
   }

   public function scopeSiteBlocks($query)
   {
      return $query
         ->where();
   }

   public function scopeNewPosts($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->last_login_date)
         ->orderBy('title','DESC');
   }

   public function scopePublished($query)
   {
      return $query
         ->where('published_at', '<', Carbon::now());
         // ->where('category_id', '!=', 2);
   }

   public function scopeUnpublished($query)
   {
      return $query->whereNull('published_at');
   }

   public function scopeTrashed($query)
   {
      return $query->where('deleted_at', '!=', NULL)->withTrashed();
   }


   public function scopeNewPostsCount($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->last_login_date);
   }

   public function scopeTrashedCount($query)
   {
      return $query->where('deleted_at', '!=', NULL)->withTrashed();
   }

}