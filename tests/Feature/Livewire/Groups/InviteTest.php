<?php

use App\Events\GroupInvitationCreatedEvent;
use App\Http\Livewire\Groups;
use App\Listeners\CheckIfUserExistsListener;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use App\Notifications\BePartOfGroupNotification;
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


test('if user exists notify him to be part of the group', function () {
    // Arrange
    Notification::fake();
    $user       = User::factory()->create();
    $invited    = User::factory()->create(['email' => 'jeremias@dolaravel.com']);
    $group      = Group::factory()->create(['user_id' => $user->id]);
    $invitation = GroupInvitation::create([
        'user_id'  => $user->id,
        'group_id' => $group->id,
        'email'    => 'jeremias@dolaravel.com',
    ]);

    $event = new GroupInvitationCreatedEvent($invitation);

    // Act
    $listener = new CheckIfUserExistsListener();
    $listener->handle($event);

    // Assert
    Notification::assertSentTo($invited, BePartOfGroupNotification::class);
});
