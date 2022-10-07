<?php

use App\Http\Livewire\Groups\AcceptInvitation;
use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\User;
use App\Notifications\DontWantToBePartOfGroupNotification;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('should list all invitations that I have received', function () {
    // Arrange
    $user    = User::factory()->create();
    $invited = User::factory()->create();
    $group   = Group::factory()->create();
    GroupInvitation::create(['user_id' => $user->id, 'group_id' => $group->id, 'email' => $invited->email]);
    GroupInvitation::create(['user_id' => $user->id, 'group_id' => $group->id, 'email' => 'email@qualquer.com']);

    actingAs($invited);

    // Act
    $lw = livewire(AcceptInvitation::class);

    // Assert
    $lw->assertSet('invitations', function ($invitations) use ($invited) {
        expect($invitations)
            ->toHaveCount(1)
            ->and($invitations->first())->email->toBe($invited->email);

        return true;
    });
});

it('should be able to accept the invitation', function () {
    // Arrange
    $user       = User::factory()->create();
    $invited    = User::factory()->create();
    $group      = Group::factory()->create();
    $invitation = GroupInvitation::create(['user_id' => $user->id, 'group_id' => $group->id, 'email' => $invited->email]);

    actingAs($invited);

    // Act
    $lw = livewire(AcceptInvitation::class)
        ->call('accept', $invitation->id);

    // Assert
    $lw->assertHasNoErrors()
        ->assertSet('invitations', function ($invitations) use ($invited) {
            expect($invitations)
                ->toHaveCount(0);

            return true;
        });

    assertDatabaseHas('group_user', [
        'group_id' => $group->id,
        'user_id'  => $invited->id,
    ]);

    assertDatabaseCount(GroupInvitation::class, 0);
});


it('should be able to reject the invitation', function () {
    // Arrange
    Notification::fake();
    $user       = User::factory()->create();
    $invited    = User::factory()->create();
    $group      = Group::factory()->create();
    $invitation = GroupInvitation::create(['user_id' => $user->id, 'group_id' => $group->id, 'email' => $invited->email]);

    actingAs($invited);

    // Act
    $lw = livewire(AcceptInvitation::class)
        ->call('reject', $invitation->id);

    // Assert
    $lw->assertHasNoErrors()
        ->assertSet('invitations', function ($invitations) use ($invited) {
            expect($invitations)
                ->toHaveCount(0);

            return true;
        });

    assertDatabaseCount('group_user', 0);
    assertDatabaseCount(GroupInvitation::class, 0);

    Notification::assertSentTo($user, DontWantToBePartOfGroupNotification::class);
});
