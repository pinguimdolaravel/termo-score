<?php

namespace App\Http\Livewire;

use App\Models\DailyScore;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDailyScore extends Component
{
    public ?string $score = null;

    public function render(): Factory|View|Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
        $gameId = '#' . str($this->score)->betweenFirst('#', ' ')->toString();
        $score  = str($this->score)->explode('/')->reduce(function ($a, $b, $c) {
            if ($c == 0) {
                return str($b)->substr(-1, 1)->toString();
            }
            return $a . '/' . str($b)->substr(0, 1)->toString();
        }, '');

        $detail = explode(PHP_EOL, $this->score);
        unset($detail[0]);
        unset($detail[1]);

        $detail = trim(implode(PHP_EOL, $detail));

        DailyScore::query()
            ->create([
                'game_id' => $gameId,
                'score'   => $score,
                'detail'  => $detail,
            ]);
    }
}
