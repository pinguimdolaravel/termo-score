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

it('should be able to update a group name', function () {
    $group = Group::factory()->createOne(['name' => 'Old Test Group']);

    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', 'New Test Group')
        ->call('save')
        ->assertHasNoErrors();

    expect($group->refresh())
        ->name->toBe('New Test Group');
});

it('should check if the person that is trying to edit the group owns the group', function () {
    $kira = User::factory()->createOne();

    $kiraGroup = Group::factory()->create(['user_id' => $kira->id, 'name' => 'Kira Group']);

    livewire(Groups\Update::class, compact('kiraGroup'))
        ->assertForbidden();
});

#region Validations
test('name should be required', function () {
    $group = Group::factory()->createOne(['name' => 'Old Test Group']);
    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', '')
        ->call('save')
        ->assertHasErrors(['group.name' => 'required']);
});

test('name should be a valid string', function () {
    $group = Group::factory()->createOne(['name' => 'Old Test Group']);
    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', 1)
        ->call('save')
        ->assertHasErrors(['group.name' => 'string']);
});

test('name should have a min of 3 characters', function () {
    $group = Group::factory()->createOne(['name' => 'Old Test Group']);
    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', 'a')
        ->call('save')
        ->assertHasErrors(['group.name' => 'min']);
});

test('name should have a max of 30 characters', function () {
    $group = Group::factory()->createOne(['name' => 'Old Test Group']);
    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', str_repeat('a', 31))
        ->call('save')
        ->assertHasErrors(['group.name' => 'max']);
});

test('name should be unique', function () {
    Group::factory()->create(['name' => 'Test Group']);

    $group = Group::factory()->createOne(['name' => 'Old Test Group']);

    livewire(Groups\Update::class, compact('group'))
        ->set('group.name', 'Test Group')
        ->call('save')
        ->assertHasErrors(['group.name' => 'unique']);
});

#endregion
