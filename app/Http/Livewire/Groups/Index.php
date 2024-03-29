<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\GroupInvitation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

/**
 * @property-read Collection|Group[] $groups
 * @property-read bool $hasInvitations
 */
class Index extends Component
{
    public string $nome = 'Eduardo';

    public int $create = 0;

    protected $listeners = [
        'group::refresh-list' => 'refreshList',
    ];

    public function render(): Factory|View|Application
    {
        return view('livewire.groups.index');
    }

    public function getGroupsProperty()
    {
        return auth()->user()->groups;
    }

    public function getHasInvitationsProperty(): bool
    {
        return GroupInvitation::whereEmail(auth()->user()->email)->exists();
    }

    public function refreshList()
    {
        $this->create = 0;
    }
}
