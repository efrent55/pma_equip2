<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Log;

class SuccessLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //dd(auth()->user()->id);
        $log = new Log();
        $log->activity = 'System Logout';
        $log->user_id = auth()->user()->id;
        $log->ip_address = request()->ip();
        $log->save();
    }
}
