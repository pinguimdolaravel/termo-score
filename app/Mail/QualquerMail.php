<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QualquerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Qualquer email sem markdown';

    public function build(): self
    {
        return $this->view('mail.qualquer-email');
    }
}
