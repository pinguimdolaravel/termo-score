<?php

namespace App\Listeners;

use App\Events\GroupInvitationCreatedEvent;
use App\Models\User;
use App\Notifications\BePartOfGroupNotification;

class CheckIfUserExistsListener
{
    public function handle(GroupInvitationCreatedEvent $event): void
    {
        if ($user = User::whereEmail($event->invitation->email)->first()) {
            $user->notify(new BePartOfGroupNotification());
        }
    }
}
