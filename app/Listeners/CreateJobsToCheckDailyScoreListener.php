<?php

namespace App\Listeners;

use App\Events\WordOfDayCreatedEvent;
use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;

class CreateJobsToCheckDailyScoreListener
{
    public function handle(WordOfDayCreatedEvent $event): void
    {
        DailyScore::query()
            ->whereStatus('pending')
            ->whereGameId($event->wordOfDay->game_id)
            ->get()
            ->each(function (DailyScore $dailyScore) use ($event) {
                dispatch(new CheckDailyScoreJob($event->wordOfDay, $dailyScore));
            });
    }
}
