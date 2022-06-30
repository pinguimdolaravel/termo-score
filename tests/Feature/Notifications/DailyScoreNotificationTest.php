<?php

use App\Models\DailyScore;
use App\Notifications\DailyScoreNotification;
use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertEquals;

beforeEach(function () {
    $this->dailyScore = DailyScore::factory()
        ->create([
            'game_id' => 1,
            'score'   => '1/6',
            'word'    => 'score',
            'status'  => DailyScore::STATUS_FINISHED,
            'points'  => 10,
        ]);
});

it('should save the notification in the database', function () {
    $this->dailyScore->user->notifyNow(new DailyScoreNotification($this->dailyScore));

    assertDatabaseCount('notifications', 1);
});

it('should make sure that the notification is being sent to database and email', function () {
    Notification::fake();

    $this->dailyScore->user->notifyNow(new DailyScoreNotification($this->dailyScore));

    Notification::assertSentTo(
        $this->dailyScore->user,
        DailyScoreNotification::class,
        function (DailyScoreNotification $notification) {
            return $notification->via() === ['database', 'mail'];
        }
    );
});

it('should make sure that the database data is saved correctly', function () {
    Notification::fake();

    $this->dailyScore->user->notifyNow(new DailyScoreNotification($this->dailyScore));

    Notification::assertSentTo(
        $this->dailyScore->user,
        DailyScoreNotification::class,
        function (DailyScoreNotification $notification) {
            assertEquals(
                [
                    'message' => "Your daily entry was analyzed. You got {$this->dailyScore->points} new points. 🎉",
                    'status'  => 'success',
                ],
                $notification->toArray($this->dailyScore->user)
            );

            return true;
        }
    );
});

test('check email format', function () {
    Notification::fake();

    $this->dailyScore->user->notifyNow(new DailyScoreNotification($this->dailyScore));

    Notification::assertSentTo(
        $this->dailyScore->user,
        DailyScoreNotification::class,
        function (DailyScoreNotification $notification) {
            $mail = $notification->toMail($this->dailyScore->user);

            expect($mail)
                ->greeting->toBe($this->dailyScore->user->name)
                ->introLines->toBe(['Your daily entry was analyzed.', "You got {$this->dailyScore->points} new points."])
                ->actionText->toBe('Check Your Points')
                ->actionUrl->toBe(route('dashboard'))
                ->outroLines->toBe(['Congratulations 🎉🎉🎉 Jetete!!!']);

            return true;
        }
    );
});
