<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class DailyScore extends Model
{
    public function gameId(): Attribute
    {
        return new Attribute(
            set: fn ($value) => str($value)->replace('#', '')
        );
    }
}
