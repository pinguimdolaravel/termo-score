<?php

namespace App\Console\Commands;

use App\Events\ChegueiA10Pessoas;
use Illuminate\Console\Command;

class Playground extends Command
{
    protected $signature = 'play';

    protected $description = 'Command description';

    public function handle()
    {
        event(new ChegueiA10Pessoas());
        
        return 0;
    }
}
