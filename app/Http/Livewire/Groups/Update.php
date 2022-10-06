<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    use AuthorizesRequests;

    public ?Group $group = null;

    public int $editing = 0;

    public function getRules(): array
    {
        return [
            'group.name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                Rule::unique('groups', 'name')
                    ->ignore($this->group),
            ],
        ];
    }

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

        $this->editing = 0;
    }
}
