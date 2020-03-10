<?php

namespace App\Listeners;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LastLogin
{
   /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login $event
     * @return void
    */
   public function handle(Login $event)
   {
      // Copy last_log_date to previous_login_date
      $event->user->update(['previous_login_date' => $event->user->last_login_date]);
      // Update user when logging in
      $event->user->update(['last_login_date' => Carbon::now()]);
      $event->user->increment('login_count');
      // activity()->log('User logged in');
      activity()
         // ->causedBy($event->user)
         ->performedOn($event->user)
         ->log('Login');
   }
}