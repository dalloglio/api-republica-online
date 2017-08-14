<?php

namespace App\Listeners;

use App\Events\LoginFacebook;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPasswordExchange
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginFacebook  $event
     * @return void
     */
    public function handle(LoginFacebook $event)
    {
        $event->user->password_backup = $event->user->password;
        $event->user->password = $event->request->id;
        $event->user->save();
    }
}
