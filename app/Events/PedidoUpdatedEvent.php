<?php

namespace App\Events;

use App\Models\Pedido;
use Illuminate\Foundation\Events\Dispatchable;

class PedidoUpdatedEvent
{
    use Dispatchable;

    public function __construct(public Pedido $pedido)
    {
        //
    }
}
