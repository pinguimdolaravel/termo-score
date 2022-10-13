<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BePartOfGroupNotification extends Notification
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
            ->line('Você foi convidado para fazer parte de um grupo no Termo-Score.')
            ->action('Clique aqui para aceitar o convite!', url('/'))
            ->line('Grato desde já! Vai tricolooooor! Nunca fui rebaixado.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
