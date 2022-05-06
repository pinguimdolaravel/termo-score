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
        //
    }

    public function handle()
    {
        if ($this->wordOfDayAndDailyScoreHasDifferentGameId()) {
            return;
        }

        [$points, $status] = $this->checkPointsAndStatus();

        $this->dailyScore->points = $points;
        $this->dailyScore->status = $status;
        $this->dailyScore->save();
    }

    private function checkPointsAndStatus(): array
    {
        $points = match ($this->dailyScore->score) {
            '1/6' => 10,
            '2/6' => 5,
            '3/6' => 4,
            '4/6' => 2,
            '5/6' => 1,
            '6/6' => 0,
            'X/6' => -1,
            default => null
        };

        $status = DailyScore::STATUS_FINISHED;

        if ($this->wordOfDay->word !== $this->dailyScore->word) {
            $points = 0;
            $status = DailyScore::STATUS_WRONG_WORD;
        }

        return [$points, $status];
    }

    private function wordOfDayAndDailyScoreHasDifferentGameId(): bool
    {
        return $this->wordOfDay->game_id !== $this->dailyScore->game_id;
    }
}
