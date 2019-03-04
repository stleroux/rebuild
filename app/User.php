<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends Authenticatable
{
    use Notifiable;
    use Favoriteability;

    protected $dates = ['last_login_date'];
    
    protected $fillable = [
        'username', 'email', 'password', 'last_login_date','public_email'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
        // ->withTrashed();
    }

    // public function comments()
    // {
    //     return $this->hasMany('App\Comment');
    // }

}
