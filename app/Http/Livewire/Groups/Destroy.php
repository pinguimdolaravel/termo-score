<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Destroy extends Component
{
    use AuthorizesRequests;

    public ?Group $group = null;

    public function mount()
    {
        $this->authorize('delete', $this->group);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.groups.destroy');
    }

    public function destroy()
    {
        $this->group->delete();
        $this->emitTo(Index::class, 'group::refresh-list');
    }
}
