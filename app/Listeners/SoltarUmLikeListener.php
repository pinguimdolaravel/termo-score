<?php

namespace App\Listeners;

use App\Events\UserSavedEvent;

class SoltarUmLikeListener
{
    public function handle(UserSavedEvent $event)
    {
        sleep(1);
        logger('soltei um like :: ' . __CLASS__);
    }
}
