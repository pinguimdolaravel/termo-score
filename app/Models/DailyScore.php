<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyScore extends Model
{
    use HasFactory;

    const STATUS_FINISHED   = 'finished';
    const STATUS_WRONG_WORD = 'wrong_word';
    const STATUS_PENDING    = 'pending';

    public function gameId(): Attribute
    {
        return new Attribute(
            set: fn ($value) => (int)str($value)->replace('#', '')->toString()
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
