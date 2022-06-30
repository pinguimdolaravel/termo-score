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

it('should be able to create a new group', function () {
    livewire(Groups\Create::class)
        ->set('group.name', 'Test Group')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseCount(Group::class, 1);
});

#region Validations
test('name should be required', function () {
    livewire(Groups\Create::class)
        ->call('save')
        ->assertHasErrors(['group.name' => 'required']);
});

test('name should be a valid string', function () {
    livewire(Groups\Create::class)
        ->set('group.name', 1)
        ->call('save')
        ->assertHasErrors(['group.name' => 'string']);
});

test('name should have a min of 3 characters', function () {
    livewire(Groups\Create::class)
        ->set('group.name', 'a')
        ->call('save')
        ->assertHasErrors(['group.name' => 'min']);
});

test('name should have a max of 30 characters', function () {
    livewire(Groups\Create::class)
        ->set('group.name', str_repeat('a', 31))
        ->call('save')
        ->assertHasErrors(['group.name' => 'max']);
});

test('name should be unique', function () {
    Group::factory()->create(['name' => 'Test Group']);

    livewire(Groups\Create::class)
        ->set('group.name', 'Test Group')
        ->call('save')
        ->assertHasErrors(['group.name' => 'unique']);
});

#endregion
