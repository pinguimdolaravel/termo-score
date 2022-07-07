<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Update extends Component
{
    use AuthorizesRequests;

    public ?Group $group = null;

    protected array $rules = [
        'group.name' => ['required', 'string', 'min:3', 'max:30', 'unique:groups,name'],
    ];

    public function mount()
    {
        $this->authorize('update', $this->group);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.groups.update');
    }

    public function save()
    {
        $this->validate();

        $this->group->save();
        
        $this->emitTo(Index::class, 'group::refresh-list');
    }
}
