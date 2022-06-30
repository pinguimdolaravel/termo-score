<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public Group $group;

    protected array $rules = [
        'group.name' => ['required', 'string', 'min:3', 'max:30', 'unique:groups,name'],
    ];

    public function mount()
    {
        $this->group = new Group();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.groups.create');
    }

    public function save()
    {
        $this->validate();

        $this->group->user_id = auth()->id();
        $this->group->save();
    }
}
