<?php

namespace App\Models\Darts;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
   protected $table = "dart__scores";

   protected $fillable = [
      'user_id',
      'team_id',
      'game_id',
      'score',
      'remaining'
    ];

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   // public function game()
   // {
   //    return $this->belongsTo(\App\Models\Darts\Game::class, 'dart__games');
   // }

   // public function user()
   // {
   //    return $this->belongsTo(\App\Models\User::class, 'users');
   // }

}
