<?php

use App\Http\Livewire\DailyScores;
use App\Models\DailyScore;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('should list all daily scores from the authenticated user', function () {
    $user = User::factory()->createOne();
    DailyScore::factory()->count(5)->for($user, 'user')->create();
    DailyScore::factory()->count(10)->for(User::factory()->create(), 'user')->create();

    actingAs($user);

    livewire(DailyScores::class)
        ->assertCount('scores', 5)
        ->assertSet('scores', function (Collection $scores) use ($user) {
            return $scores->filter(fn (DailyScore $score) => $score->user->is($user))->count() == 5;
        });
});

it('should show a total of points of all time', function () {
    $user = User::factory()->createOne();
    DailyScore::factory()->withPoints()->count(5)->for($user, 'user')->create();
    $total = $user->dailyScores()->sum('points');

    actingAs($user);
    livewire(DailyScores::class)
        ->assertSee('Total Points: ' . $total);
});
