<?php

namespace App\Listeners;

use App\Events\ChegueiA10Pessoas;
use Illuminate\Contracts\Queue\ShouldQueue;

class MandoUmEmailQualquerListener implements ShouldQueue
{
    public function handle(ChegueiA10Pessoas $event)
    {
        sleep(1);
        logger('mandei um email : ' . __CLASS__);
    }
}
