<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Group $group): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Group $group): bool
    {
        return $user->is($group->user);
    }

    public function delete(User $user, Group $group): bool
    {
    }

    public function restore(User $user, Group $group): bool
    {
    }

    public function forceDelete(User $user, Group $group): bool
    {
    }
}
