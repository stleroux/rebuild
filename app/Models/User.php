<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
   use Favoriteability;
   use Notifiable;
   use SoftDeletes;
   use Sortable;

   protected $dates = ['last_login_date'];
    
   // protected $fillable = [
   //     'username', 'email', 'password', 'last_login_date','public_email'
   // ];

   protected $guarded = [];

   protected $hidden = [
      'password', 'remember_token',
   ];

   // Set the default value for the status field to 0
   protected $attributes = [
      'invoicer_client' => 0,
   ];

   public function getInvoicerclientAttribute($attribute)
   {
      return $this->invoicerclientOptions()[$attribute];
   }

   public function invoicerclientOptions()
   {
      return [
         0 => 'No',
         1 => 'Yes',
      ];
   }

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   public function permissions()
   {
      return $this->belongsToMany('App\Models\Permission');
   }

   // public function profile()
   // {
   //     return $this->hasOne('App\Models\Profile');
   //     // ->withTrashed();
   // }

   // public function comments()
   // {
   //     return $this->hasMany('App\Comment');
   // }

   // A client has many invoices
   public function invoices() {
      return $this->hasMany('App\Models\Invoicer\Invoice')->orderBy('id','desc');
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

   public function getLastLoginDateAttribute($date)
   {
      if($date){
         $date = new \Carbon\Carbon($date);
         $date = $date->format(setting('dateFormat'));
         return $date;
      }
      
      return 'N/A';
   }




   public function getContactNameAttribute()
   {
       return "{$this->first_name} {$this->last_name}";
   }
}
