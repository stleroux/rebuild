<?php

namespace App\Models\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Test extends Model
{
   use SoftDeletes;
   use Favoriteable;

   protected $guarded = [];

   protected $dates = [];


   // Set the default value for the status field to 0
   protected $attributes = [
      'status' => 0,
   ];

   public function getStatusAttribute($attribute)
   {
      return $this->statusOptions()[$attribute];
   }

   public function statusOptions()
   {
      return [
         1 => 'Active',
         0 => 'Inactive',
         2 => 'In-Progress',
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
      return $query->where('published_at', '<', Carbon::now());
   }

   public function scopeMytests($query)
   {
      return $query->where('user_id', '=', Auth::user()->id)->orderBy('name','DESC');
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

   public function scopeNewtests($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->previous_login_date)
         ->orderBy('name','DESC');
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