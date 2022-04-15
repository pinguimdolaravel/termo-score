<?php

namespace App\Http\Livewire;

use App\Actions\DailyEntry;
use App\Models\DailyScore;
use App\Rules\DetailRule;
use App\Rules\GameIdRule;
use App\Rules\ScoreRule;
use App\Rules\WordIsValidRule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LogDailyScore extends Component
{
    public ?string $data = null;

    public ?string $word = null;

    public ?string $word_confirmation = null;

    public ?string $gameId = null;

    public ?string $score = null;

    public ?string $detail = null;

    public ?string $message = null;

    public function render(): Factory|View|Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
        $this->validate([
            'data' => 'required',
            'word' => ['required', 'size:5', 'confirmed'],
        ]);

        [$this->gameId, $this->score, $this->detail] = (new DailyEntry)->parseData($this->data);

        $this->validate([
            'gameId' => ['required', new GameIdRule()],
            'score'  => ['required', new ScoreRule()],
            'detail' => ['required', new DetailRule()],
        ]);

        $this->validate([
            'word' => new WordIsValidRule($this->gameId),
        ]);

        DailyScore::query()
            ->create([
                'game_id' => $this->gameId,
                'score'   => $this->score,
                'detail'  => $this->detail,
                'word'    => $this->word,
                'status'  => 'pending',
            ]);

        $this->message = 'Your score is being calculated.';
    }
}
