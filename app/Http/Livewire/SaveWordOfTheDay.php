<?php

namespace App\Http\Livewire;

use App\Models\WordOfDay;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SaveWordOfTheDay extends Component
{
    use AuthorizesRequests;

    public ?string $word = null;

    public ?string $word_confirmation = null;

    public ?int $game_id = null;

    public ?string $status = null;

    public function render(): Factory|View|Application
    {
        $this->authorize('admin');

        return view('livewire.save-word-of-the-day');
    }

    public function save()
    {
        $this->validate([
            'word'    => ['required', 'confirmed', 'string', 'size:5'],
            'game_id' => ['required', 'integer', 'unique:word_of_days,game_id'],
        ]);

        WordOfDay::query()
            ->create([
                'word'    => $this->word,
                'game_id' => $this->game_id,
            ]);

        $this->status = "Word saved";
        $this->reset('word', 'game_id');
    }
}
