<?php

namespace App\Listeners;

use App\Jobs\NotificationFCMJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFCMListner
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $event->data;
        NotificationFCMJob::dispatch($data);
    }
}
