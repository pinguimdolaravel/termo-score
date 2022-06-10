<?php

namespace App\Models;

use App\Events\WordOfDayCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WordOfDay
 *
 * @property int $id
 * @property int $game_id
 * @property string $word
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WordOfDayFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay query()
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WordOfDay whereWord($value)
 * @mixin \Eloquent
 */
class WordOfDay extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => WordOfDayCreatedEvent::class,
    ];
}
