<?php

use App\Http\Livewire\Auth\Login;
use App\Models\User;
use function Pest\Livewire\livewire;

it('should be able to login', function () {
    $user = User::factory()->create(['email' => 'pinguim@dolaravel.com']);

    livewire(Login::class)
        ->set('email', 'pinguim@dolaravel.com')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect();

    expect(auth())
        ->check()->toBeTrue()
        ->user()->id->toBe($user->id);
});
