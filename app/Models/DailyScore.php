<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyScore extends Model
{
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->game_id = str($model->game_id)->replace('#', '');
        });
    }
}
