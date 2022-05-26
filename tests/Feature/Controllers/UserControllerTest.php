<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_password_only_if_is_the_same_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var User $user2 */
        $user2 = User::factory()->create();

        $this->actingAs($user)
            ->get(route('user.show', $user2))
            ->assertJsonMissing(['password']);

        $this->actingAs($user)
            ->get(route('user.show', $user))
            ->assertJsonFragment(['password' => $user->password]);
    }

    /** @test */
    public function it_should_block_if_is_not_the_same_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var User $user2 */
        $user2 = User::factory()->create();

        $this->actingAs($user)
            ->get(route('user.show', $user2))
            ->assertForbidden();

        $this->actingAs($user)
            ->get(route('user.show', $user))
            ->assertSuccessful();
    }
}
