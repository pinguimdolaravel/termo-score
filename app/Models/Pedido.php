<?php

namespace App\Models;

use App\Events\PedidoUpdatedEvent;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $dispatchesEvents = [
        'updated' => PedidoUpdatedEvent::class,
    ];
}
