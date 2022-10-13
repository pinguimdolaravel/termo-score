<?php

namespace App\Http\Livewire\Groups;

use App\Models\GroupInvitation;
use App\Notifications\DontWantToBePartOfGroupNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

/**
 * @property-read Collection|GroupInvitation[] $invitations
 */
class AcceptInvitation extends Component
{
    public function render(): View
    {
        return view('livewire.groups.accept-invitation');
    }

    public function getInvitationsProperty(): Collection
    {
        return GroupInvitation::whereEmail(auth()->user()->email)->get();
    }

    public function accept($invitationId): void
    {
        /** @var GroupInvitation $invitation */
        $invitation = GroupInvitation::find($invitationId);
        $invitation->group->users()->attach(auth()->user());

        $invitation->delete();
    }

    public function reject($invitationId): void
    {
        /** @var GroupInvitation $invitation */
        $invitation = GroupInvitation::find($invitationId);
        $invitation->user->notify(new DontWantToBePartOfGroupNotification);

        $invitation->delete();
    }
}
