<?php

use App\Http\Livewire\Groups;
use App\Models\Group;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('should be able to delete a group', function () {
    $group = Group::factory()->createOne(['user_id' => $this->user->id]);

    livewire(Groups\Destroy::class, compact('group'))
        ->call('destroy');

    assertDatabaseCount(Group::class, 0);
});

it('should check if the person that is trying to edit the group owns the group', function () {
    $kira = User::factory()->createOne();

    $kiraGroup = Group::factory()->create(['user_id' => $kira->id, 'name' => 'Kira Group']);

    livewire(Groups\Destroy::class, compact('kiraGroup'))
        ->assertForbidden();
});
