<?php

namespace App\Http\Livewire;

use App\Models\DailyScore;
use App\Rules\DetailRule;
use App\Rules\GameIdRule;
use App\Rules\ScoreRule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDailyScore extends Component
{
    public ?string $data = null;

    public ?string $gameId = null;

    public ?string $score = null;

    public ?string $detail = null;

    public function render(): Factory|View|Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
        $this->data   = trim($this->data);
        $this->gameId = '#' . str($this->data)->betweenFirst('#', ' ')->toString();
        $this->score  = str($this->data)->explode('/')->reduce(function ($a, $b, $c) {
            if ($c == 0) {
                return str($b)->afterLast(' ')->toString();
            }
            return $a . '/' . str($b)->before(' ')->toString();
        }, '');

        $detail = explode(PHP_EOL, $this->data);
        unset($detail[0]);
        unset($detail[1]);

        $this->detail = trim(implode(PHP_EOL, $detail));

        $this->validate([
            'gameId' => ['required', new GameIdRule()],
            'score'  => ['required', new ScoreRule()],
            'detail' => ['required', new DetailRule()],
        ]);

        DailyScore::query()
            ->create([
                'game_id' => $this->gameId,
                'score'   => $this->score,
                'detail'  => $this->detail,
            ]);
    }
}
