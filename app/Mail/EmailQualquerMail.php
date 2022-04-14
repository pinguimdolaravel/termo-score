<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EmailQualquerMail extends Mailable
{
    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->markdown('emails.email-qualquer');
    }
}
