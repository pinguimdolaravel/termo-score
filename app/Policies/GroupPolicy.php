<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Group $group): bool
    {
        return $user->is($group->user);
    }

    public function delete(User $user, Group $group): bool
    {
        return $user->is($group->user);
    }
}
