<?php

namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use OwenIt\Auditing\Contracts\Auditable;
// use Spatie\Activitylog\Traits\LogsActivity;

class Article extends Model implements Auditable
{
   use SoftDeletes;
   use Favoriteable;
   use \OwenIt\Auditing\Auditable;
   // use LogsActivity;

   protected $guarded = [];

   protected $dates = ['published_at'];

   // protected static $logAttributes = ['*'];
   // protected static $logName = 'article';
   //events will get logged automatically
   // protected static $recordEvents = ['created','updated','deleted'];

   // protected $revisionCreationsEnabled = true;


   // Set the default value for the category field to 0
   protected $attributes = [
      'category' => 0,
      'status' => 0,
   ];

   public function getCategoryAttribute($attribute)
   {
      return $this->categoriesOptions()[$attribute];
   }

   public function categoriesOptions()
   {
      return [
         0 => '',
         1 => 'EKME',
         2 => 'GCCMS',
         3 => 'DFO-Forms',
         4 => 'AEM',
         5 => 'Windows',
         6 => 'Office',
         7 => 'Other',
         8 => 'RM Admin'
      ];
   }

      // Set the default value for the status field to 0
   // protected $attributes = [
   //    'status' => 0,
   // ];

   public function getStatusAttribute($attribute)
   {
      return $this->statusesOptions()[$attribute];
   }

   public function statusesOptions()
   {
      return [
         1 => 'Active',
         0 => 'Inactive',
         2 => 'In-Progress',
         3 => 'Three',
         4 => 'Four',
         5 => 'Five',
         6 => 'Six',
         7 => 'Seven',
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

   public function scopeMyarticles($query)
   {
      return $query
         ->where('user_id', '=', Auth::user()->id);
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

   public function scopeNewarticles($query)
   {
      return $query
         ->where('created_at', '>=' , Auth::user()->previous_login_date);
   }

//////////////////////////////////////////////////////////////////////////////////////
// ACCESSORS
//////////////////////////////////////////////////////////////////////////////////////
   // public function getCreatedAtAttribute($date)
   // {
   //    if($date){
   //       $date = new \Carbon\Carbon($date);
   //       $date = $date->format(setting('dateFormat'));
   //       return $date;
   //    }
      
   //    // return 'N/A';
   // }

   // public function getUpdatedAtAttribute($date)
   // {
   //    if($date){
   //       $date = new \Carbon\Carbon($date);
   //       $date = $date->format(setting('dateFormat'));
   //       return $date;
   //    }
      
   //    // return 'N/A';
   // }

   // public function getPublishedAtAttribute($date)
   // {
   //    if($date){
   //       $date = new \Carbon\Carbon($date);
   //       $date = $date->format(setting('dateFormat'));
   //       return $date;
   //    }
      
   //    // return 'N/A';
   // }

   // public function getUserIdAttribute($id)
   // {
   //    $author = User::find($id);

   //    if(setting('authorFormat') == 'username'){
   //       return ucfirst($author->username);
   //    }
   //    if(setting('authorFormat') == 'last_name, first_name'){
   //       return ucfirst($author->last_name) . ', ' . ucfirst($author->first_name);
   //    }
   //    if(setting('authorFormat') == 'first_name last_name'){
   //       return ucfirst($author->first_name) . ' ' . ucfirst($author->last_name);
   //    }
   // }



}