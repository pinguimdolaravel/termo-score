<?php

namespace App\Http\Livewire;

use App\Models\DailyScore;
use Livewire\Component;

class DailyChart extends Component
{
    public array $labels = [];

    public array $data = [];

    public function mount()
    {
        $scores = DailyScore::query()->select(['game_id', 'points'])->orderBy('game_id')->get();

        $this->labels = $scores->map(fn ($score) => ['game_id' => 'Game ' . $score->game_id])
            ->pluck('game_id')->toArray();
        $this->data   = $scores->pluck('points')->toArray();
    }

    public function render()
    {
        return view('livewire.daily-chart');
    }
}
