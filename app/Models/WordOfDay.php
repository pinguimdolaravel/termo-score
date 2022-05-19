<?php

namespace App\Models;

use App\Events\WordOfDayCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordOfDay extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => WordOfDayCreatedEvent::class,
    ];
}
