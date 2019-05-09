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
        // Update user when logging in
        $event->user->update(['last_login_date' => Carbon::now()]);
        $event->user->increment('login_count');
    }
}