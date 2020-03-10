<?php

namespace App\Models\Movies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use App\Models\User;
use Kyslik\ColumnSortable\Sortable;

class Movie extends Model
{
   use SoftDeletes;
   use Favoriteable;
   use Sortable;

   protected $guarded = [];

   protected $dates = ['published_at'];

   public $sortable = ['col_no', 'title', 'category', 'views', 'running_time', 'created_at', 'updated_at'];

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
         0 => '',
         1 => 'Action',
         2 => 'Adult',
         3 => 'Adventure',
         4 => 'Animation',
         5 => 'Anime',
         6 => 'Children',
         7 => 'Classic',
         8 => 'Comedy',
         9 => 'Crime',
         10 => 'Disaster',
         11 => 'Documentary',
         12 => 'Drama',
         13 => 'Family',
         14 => 'Fantasy',
         15 => 'Film Noir',
         16 => 'Horror',
         17 => 'Martial Arts',
         18 => 'Musical',
         19 => 'Romance',
         20 => 'Science-Fiction',
         21 => 'Special Interest',
         22 => 'Sports',
         23 => 'Suspense / Thriller',
         24 => 'Television',
         25 => 'War',
         26 => 'Western',
      ];
   }

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function comments()
   {
      return $this->morphMany('\App\Models\Comment', 'commentable')->orderBy('id','desc');
   }
   
   public function user()
   {
      return $this->belongsTo('App\Models\User');
   }

//////////////////////////////////////////////////////////////////////////////////////
// SCOPES
//////////////////////////////////////////////////////////////////////////////////////
public function scopePublished($query)
   {
      return $query
         ->where('published_at', '<', Carbon::now())
         ->where('deleted_at', NULL);
   }

   public function scopeMymovies($query)
   {
      return $query
         ->where('user_id', '=', Auth::user()->id)
         ->orderBy('title','DESC');
   }

   public function scopeUnpublished($query)
   {
      return $query
         ->whereNull('published_at');
   }

   public function scopeFuture($query)
   {
      return $query
         ->where('published_at', '>', Carbon::Now());
   }
   
   public function scopeTrashed($query)
   {
      return $query
         ->whereNotNull('deleted_at')
         ->withTrashed();
   }

   public function scopeTrashedCount($query)
   {
      return $query
         ->whereNotNull('deleted_at')
         ->withTrashed();
   }

   public function scopeNewmovies($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->previous_login_date)
         ->orderBy('title','DESC');
   }

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
   }

   public function getUpdatedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
   }

   public function getPublishedAtAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
   }

}
