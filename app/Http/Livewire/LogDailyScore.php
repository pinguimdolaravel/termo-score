<?php

namespace App\Http\Livewire;

use App\Actions\DailyEntry;
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
        [$this->gameId, $this->score, $this->detail] = (new DailyEntry)->parseData($this->data);

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
