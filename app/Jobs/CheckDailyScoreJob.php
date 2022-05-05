<?php

namespace App\Jobs;

use App\Models\DailyScore;
use App\Models\WordOfDay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckDailyScoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public WordOfDay  $wordOfDay,
        public DailyScore $dailyScore
    )
    {
    }

    public function handle()
    {
        $points = match ($this->dailyScore->score) {
            '1/6' => 10,
            '2/6' => 5,
            '3/6' => 4,
            '4/6' => 2,
            '5/6' => 1,
            '6/6' => 0,
            'X/6' => -1,
        };

        $this->dailyScore->points = $points;
        $this->dailyScore->status = DailyScore::STATUS_FINISHED;
        $this->dailyScore->save();
    }
}
