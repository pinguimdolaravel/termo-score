<?php

namespace App\Events;

use App\Models\WordOfDay;
use Illuminate\Foundation\Events\Dispatchable;

class WordOfDayCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public WordOfDay $wordOfDay
    ) {
        //
    }
}
