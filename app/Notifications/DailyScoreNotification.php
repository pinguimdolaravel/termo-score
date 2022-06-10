<?php

namespace App\Notifications;

use App\Models\DailyScore;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DailyScoreNotification extends Notification
{
    use Queueable;

    public function __construct(
        public DailyScore $dailyScore
    )
    {
        //
    }

    public function via(): array
    {
        return ['database', 'mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting($notifiable->name)
            ->line('Your daily entry was analyzed.')
            ->line("You got {$this->dailyScore->points} new points.")
            ->action('Check Your Points', url()->route('dashboard'))
            ->line('Congratulations 🎉🎉🎉 Jetete!!!');
    }

    public function toArray(User $notifiable): array
    {
        return [
            'message' => "Your daily entry was analyzed. You got {$this->dailyScore->points} new points. 🎉",
            'status'  => 'success',
        ];
    }
}
