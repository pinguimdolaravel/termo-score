<?php

use App\Http\Livewire\Groups;
use App\Models\Group;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = User::factory()->createOne();
    actingAs($this->user);
});

it('should list all the groups that I own', function () {
    $groupsThatIOwn     = Group::factory()->count(3)->create(['user_id' => $this->user->id]);
    $groupsThatIDontOwn = Group::factory()->count(3)->create(['user_id' => User::factory()
        ->createOne()->id]);

    livewire(Groups\Index::class)
        ->assertSet('groups', function ($groups) use ($groupsThatIDontOwn, $groupsThatIOwn) {
            $iOwn = $groupsThatIOwn->whereIn('id', $groups->pluck('id'));

            if ($iOwn->count() !== 3) {
                return false;
            }

            $iDontOwn = $groupsThatIDontOwn->whereIn('id', $groups->pluck('id'));

            if ($iDontOwn->count() === 3) {
                return false;
            }

            return true;
        });
});
