<?php

use App\Http\Livewire\LogDailyScore;
use App\Models\DailyScore;
use function Pest\Livewire\livewire;

it('should be able to save the daily score and track the id of the game', function ($score, $expectedGameId, $expectedScore, $expectedDetail) {
    livewire(LogDailyScore::class)
        ->set('score', $score)
        ->call('save');

    $score = DailyScore::query()->first();

    expect($score)
        ->game_id->toBe($expectedGameId)
        ->score->toBe($expectedScore)
        ->detail->toBe($expectedDetail);
})->with([
    '1.6' => [
        'joguei term.ooo #81 1/6 🔥 1' . PHP_EOL . PHP_EOL . '🟩🟩🟩🟩🟩', '#81', '1/6', '🟩🟩🟩🟩🟩',
    ],
    '2.6' => [
        'joguei term.ooo #81 2/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛🟨🟨⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        '#81',
        '2/6',
        '⬛🟨🟨⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '3.6' => [
        'joguei term.ooo #81 3/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛🟨🟨⬛🟨' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        '#81',
        '3/6',
        '⬛🟨🟨⬛🟨' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '4.6' => [
        'joguei term.ooo #81 4/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨⬛⬛⬛⬛' . PHP_EOL . '⬛⬛🟨⬛⬛' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
        '#81',
        '4/6',
        '🟨⬛⬛⬛⬛' . PHP_EOL . '⬛⬛🟨⬛⬛' . PHP_EOL . '🟩🟩🟩⬛⬛' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '5.6' => [
        'joguei term.ooo #81 5/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
        '#81',
        '5/6',
        '⬛⬛🟨🟨⬛' . PHP_EOL . '🟨🟨⬛🟨⬛' . PHP_EOL . '🟨🟩⬛⬛🟩' . PHP_EOL . '⬛🟩🟩🟨🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    '6.6' => [
        'joguei term.ooo #81 6/6 🔥 1' . PHP_EOL . PHP_EOL . '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
        '#81',
        '6/6',
        '⬛⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '🟩🟩🟩🟩🟩',
    ],
    'x.6' => [
        'joguei term.ooo #81 X/6 🔥 1' . PHP_EOL . PHP_EOL . '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩',
        '#81',
        'X/6',
        '🟨⬛⬛⬛🟨' . PHP_EOL . '⬛🟩⬛⬛🟨' . PHP_EOL . '⬛🟩🟨🟩⬛' . PHP_EOL . '🟨🟩⬛🟩⬛' . PHP_EOL . '⬛🟩🟩🟩🟩' . PHP_EOL . '⬛🟩🟩🟩🟩',
    ],
]);

