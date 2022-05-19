<?php

namespace App\Http\Livewire;

use App\Actions\DailyEntry;
use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;
use App\Models\WordOfDay;
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

    public ?string $status = null;

    public function render(): Factory|View|Application
    {
        return view('livewire.log-daily-score');
    }

    public function save()
    {
        $this->validateBaseData();

        $this->validatedGameScore();

        $score = DailyScore::query()
            ->create([
                'game_id' => $this->gameId,
                'score'   => $this->score,
                'detail'  => $this->detail,
                'word'    => $this->word,
                'status'  => 'pending',
            ]);

        $this->status = 'Your score is being calculated.';

        $this->dispatchJobIfWordOfDayExists($score);
    }

    private function validateBaseData(): void
    {
        $this->validate([
            'data' => 'required',
            'word' => ['required', 'size:5', 'confirmed'],
        ]);
    }

    private function validatedGameScore(): void
    {
        [$this->gameId, $this->score, $this->detail] = (new DailyEntry)->parseData($this->data);

        $this->validate([
            'gameId' => ['required', new GameIdRule()],
            'score'  => ['required', new ScoreRule()],
            'detail' => ['required', new DetailRule()],
        ]);

        $this->validate([
            'word' => new WordIsValidRule($this->gameId),
        ]);
    }

    private function dispatchJobIfWordOfDayExists(DailyScore $score): void
    {
        if ($wordOfDay = WordOfDay::whereGameId($score->game_id)->first()) {
            CheckDailyScoreJob::dispatch(
                $wordOfDay,
                $score
            );
        }
    }
}
