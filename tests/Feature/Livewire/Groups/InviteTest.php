<?php

use App\Events\GroupInvitationCreatedEvent;
use App\Http\Livewire\Groups;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Livewire\livewire;

it('should be able to invite someone to be part of my group', function () {
    // Arrange
    Event::fake();
    $user  = User::factory()->create();
    $group = Group::factory()->create(['user_id' => $user->id]);

    actingAs($user);

    // Act
    $lw = livewire(Groups\Invite::class, compact('group'))
        ->set('email', 'jeremias@dolaravel.com')
        ->call('save');

    // Assert
    $lw->assertHasNoErrors();

    assertDatabaseCount('group_invitations', 1);
    expect(GroupInvitation::first())
        ->email->toBe('jeremias@dolaravel.com')
        ->group_id->toBe($group->id)
        ->user_id->toBe($user->id);

    Event::assertDispatched(GroupInvitationCreatedEvent::class);
});

it('should validate fields', function () {

})->skip();

test('only owners could send an invite', function () {

})->skip();
