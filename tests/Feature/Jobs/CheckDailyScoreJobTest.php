<?php

/**
 * Score system
 * 1/6 = 10
 * 2/6 = 5
 * 3/6 = 4
 * 4/6 = 2
 * 5/6 = 1
 * 6/6 = 0
 * não conseguiu = -1
 */

use App\Jobs\CheckDailyScoreJob;
use App\Models\DailyScore;
use App\Models\WordOfDay;

it('should calculate the correct points', function ($gameScore, $expectedPoints) {
    // Arrange
    $dailyScore = DailyScore::factory()->create(['game_id' => 1, 'score' => $gameScore, 'word' => 'score']);
    $word       = WordOfDay::factory()->create(['word' => 'score', 'game_id' => 1]);

    // Act
    CheckDailyScoreJob::dispatchSync($word, $dailyScore);

    // Assert
    expect($dailyScore->refresh())
        ->points->toBe($expectedPoints)
        ->status->toBe(DailyScore::STATUS_FINISHED);
})->with([
    '10 points'  => ['1/6', 10],
    '5 points'   => ['2/6', 5],
    '4 points'   => ['3/6', 4],
    '2 points'   => ['4/6', 2],
    '1 point'    => ['5/6', 1],
    '0 points'   => ['6/6', 0],
    'not enough' => ['X/6', -1],
]);

it('should not calculate the points if the word is not the same', function () {
    // Arrange
    $dailyScore = DailyScore::factory()->create(['game_id' => 1, 'score' => '1/6', 'word' => 'phone']);
    $word       = WordOfDay::factory()->create(['word' => 'score', 'game_id' => 1]);

    // Act
    CheckDailyScoreJob::dispatchSync($word, $dailyScore);

    // Assert
    expect($dailyScore->refresh())
        ->points->toBe(0)
        ->status->toBe(DailyScore::STATUS_WRONG_WORD);
});
