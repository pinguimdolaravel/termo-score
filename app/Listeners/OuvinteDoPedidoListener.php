<?php

namespace App\Listeners;

use App\Events\PedidoUpdatedEvent;
use App\Mail\EmailQualquerMail;
use Illuminate\Support\Facades\Mail;

class OuvinteDoPedidoListener
{
    public function handle(PedidoUpdatedEvent $event)
    {
        if ($event->pedido->wasChanged('estado')) {
            logger(' agora eu faco algo jah que o estado mudou ' . __METHOD__);

            Mail::to('jeremias@jeremias.com')->send(new EmailQualquerMail());
        }
    }
}
