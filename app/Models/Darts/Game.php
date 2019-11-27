<?php

namespace App\Models\Darts;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
   protected $table = "dart__games";

   protected $fillable = [
      'type',
      't1_players',
      't2_players',
      'ind_players',
      'status'      
   ];

//////////////////////////////////////////////////////////////////////////////////////
// RELATIONSHIPS
//////////////////////////////////////////////////////////////////////////////////////
   /**
   * Get the players for the game.
   */
   // public function players()
   // {
   //   return $this->hasMany(\App\Models\Darts\Player::class, 'dart__players');
   // }

   // public function scores()
   // {
   //   return $this->belongsTo(\App\Models\Darts\Score::class, 'dart__scores');
   // }
   // protected $casts = [
   //    'team1players' => 'array',
   //    'team2players' => 'array'
   // ];

   // public function team1players()
   // {
   //    return $this->hasMany('App\User');
   // }

   // public function team2players()
   // {
   //    return $this->hasMany('App\User');
   // }

   // public function users()
   // {
   //    return $this->belongsToMany('App\User');
   // }
}
