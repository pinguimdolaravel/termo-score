<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function deleting(User $user)
    {
        logger('estou deletando o usuario' . __METHOD__);
    }

    public function deleted(User $user)
    {
        logger("user deletado :: $user->name :: " . __METHOD__);
    }
}
