<?php

namespace App\Http\Livewire\Groups;

use App\Events\GroupInvitationCreatedEvent;
use App\Models\Group;
use App\Models\GroupInvitation;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Invite extends Component
{
    public Group $group;

    public ?string $email = null;

    public function render(): View
    {
        return view('livewire.groups.invite');
    }

    public function save()
    {
        GroupInvitation::create([
            'user_id'  => auth()->id(),
            'group_id' => $this->group->id,
            'email'    => $this->email,
        ]);

        GroupInvitationCreatedEvent::dispatch();
    }
}
