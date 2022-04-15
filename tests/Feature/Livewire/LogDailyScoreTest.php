<?php

use App\Http\Livewire\LogDailyScore;
use App\Models\DailyScore;
use App\Models\WordOfDay;
use App\Rules\DetailRule;
use App\Rules\GameIdRule;
use App\Rules\ScoreRule;
use App\Rules\WordIsValidRule;
use function Pest\Livewire\livewire;

it('should be able to save the daily score and track the id of the game', function ($score, $expectedGameId, $expectedScore, $expectedDetail) {
    livewire(LogDailyScore::class)
        ->set('data', $score)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->call('save');

    $score = DailyScore::query()->first();

    expect($score)
        ->game_id->toBe($expectedGameId)
        ->score->toBe($expectedScore)
        ->detail->toBe($expectedDetail);
})->with([
    '1.6' => [
        'joguei term.ooo #81 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩', 81, '1/6', '🟩🟩🟩🟩🟩',
    ],
    '2.6' => [
        'joguei term.ooo #81 2/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛🟨🟨⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        81,
        '2/6',
        '⬛🟨🟨⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '3.6' => [
        'joguei term.ooo #81 3/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛🟨🟨⬛🟨' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        81,
        '3/6',
        '⬛🟨🟨⬛🟨' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '4.6' => [
        'joguei term.ooo #81 4/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨⬛⬛⬛⬛' . PHP_EOL . '⬛⬛🟨⬛⬛' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        81,
        '4/6',
        '🟨⬛⬛⬛⬛' . PHP_EOL . '⬛⬛🟨⬛⬛' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '5.6' => [
        'joguei term.ooo #81 5/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
        81,
        '5/6',
        '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '6.6' => [
        'joguei term.ooo #81 6/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
        81,
        '6/6',
        '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    'x.6' => [
        'joguei term.ooo #81 X/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩',
        81,
        'X/6',
        '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩',
    ],
]);

it("should warn the user if we can't save the daily score because of the format", function ($score) {
    livewire(LogDailyScore::class)
        ->set('data', $score)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->call('save')
        ->assertHasErrors([
            'gameId' => GameIdRule::class,
            'score'  => ScoreRule::class,
            'detail' => DetailRule::class,
        ]);
})->with([
    ['jeremias' . PHP_EOL . PHP_EOL . 'outro texto'],
    ['joguei term.ooo 81 12/6 🔥 1' . PHP_EOL . PHP_EOL . '🐧🐧🐧🐧🐧🐧🐧🐧'],
    ['joguei term.ooo 81 4/3 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩🟩'],
]);

it('should request for the word of the day', function () {
    livewire(LogDailyScore::class)
        ->call('save')
        ->assertHasErrors(['word' => 'required']);
});

test('word should have 5 letters', function () {
    livewire(LogDailyScore::class)
        ->set('word', '1234')
        ->call('save')
        ->assertHasErrors(['word' => 'size']);
});

it('should ask for confirmation of the word of the day', function () {
    livewire(LogDailyScore::class)
        ->set('word', 'teste')
        ->set('word_confirmation', '')
        ->call('save')
        ->assertHasErrors(['word' => 'confirmed']);
});

test('if word already exists for the given game id we should check if is valid', function () {
    WordOfDay::factory()->create(['word' => 'teste', 'game_id' => 81]);

    $data = 'joguei term.ooo #81 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩';

    livewire(LogDailyScore::class)
        ->set('data', $data)
        ->set('word', 'paulo')
        ->set('word_confirmation', 'paulo')
        ->call('save')
        ->assertHasErrors(['word' => WordIsValidRule::class]);
});

test('if word doesnt exists, we will set the status as pending and warn the user that the score is being calculated', function () {
    $data = 'joguei term.ooo #81 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩';

    livewire(LogDailyScore::class)
        ->set('data', $data)
        ->set('word', 'paulo')
        ->set('word_confirmation', 'paulo')
        ->call('save')
        ->assertHasNoErrors();

    expect(DailyScore::query()->first())
        ->ray()
        ->status->toBe('pending')
        ->word->toBe('paulo')
        ->game_id->toBe(81);
});
