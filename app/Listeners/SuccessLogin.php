<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Log;

class SuccessLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //dd(auth()->user()->id);
        $log = new Log();
        $log->activity = 'System Login';
        $log->user_id = auth()->user()->id;
        $log->ip_address = request()->ip();
        $log->save();
    }
}
