<?php

namespace App\Models\Darts;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
   protected $table = "dart__players";

   protected $fillable = [
      'id',
      'game_id',
      'team_id',
      'user_id',
      'shooting_order'
   ];

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   // public function scores()
   // {
   //   return $this->hasMany(\App\Models\Darts\Score::class, 'dart__scores');
   // }

   /**
   * Get the game that owns the player.
   */
   // public function games()
   // {
   //    return $this->belongsTo(\App\Models\Darts\Game::class, 'dart__games');
   // }

   // public function games()
   // {
   //    return $this->belongsToMany(\App\Models\Darts\Game::class, 'dart__games');
   // }

   // public function user()
   // {
   //    return $this->hasOne(\App\Models\User::class);
   // }

}