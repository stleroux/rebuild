<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends Authenticatable
{
    use Favoriteability;
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['last_login_date'];
    
    // protected $fillable = [
    //     'username', 'email', 'password', 'last_login_date','public_email'
    // ];

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
        // ->withTrashed();
    }

    // public function comments()
    // {
    //     return $this->hasMany('App\Comment');
    // }

}
