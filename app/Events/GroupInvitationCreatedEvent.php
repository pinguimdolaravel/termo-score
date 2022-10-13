<?php

namespace App\Events;

use App\Models\GroupInvitation;
use Illuminate\Foundation\Events\Dispatchable;

class GroupInvitationCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public GroupInvitation $invitation
    )
    {
    }
}
