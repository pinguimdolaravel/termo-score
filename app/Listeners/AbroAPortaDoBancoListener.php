<?php

namespace App\Listeners;

use App\Events\ChegueiA10Pessoas;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbroAPortaDoBancoListener implements ShouldQueue
{
    public function handle(ChegueiA10Pessoas $event)
    {
        sleep(1);
        logger('abri a porta do banco :: ' . __CLASS__);
    }
}
