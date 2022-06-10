<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DailyScore
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property string $score
 * @property string $detail
 * @property string|null $word
 * @property string|null $status
 * @property int|null $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\DailyScoreFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore query()
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DailyScore whereWord($value)
 * @mixin \Eloquent
 */
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
