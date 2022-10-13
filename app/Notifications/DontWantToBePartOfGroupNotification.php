<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DontWantToBePartOfGroupNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Quero nãOOO.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
