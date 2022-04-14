<?php

namespace App\Listeners;

use App\Events\ChegueiA800Subscribers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SoltarFogos
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
     * @param  \App\Events\ChegueiA800Subscribers  $event
     * @return void
     */
    public function handle(ChegueiA800Subscribers $event)
    {
        //
    }
}
