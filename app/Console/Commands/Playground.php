<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\PedidoDeAprovacao;
use Illuminate\Console\Command;

class Playground extends Command
{
    protected $signature = 'play';

    protected $description = 'Playground Command';

    public function handle(): void
    {
        // $pedido = PedidoDeAprovacao::first();
        // $pedido->approver
        $approver = User::first();

        $approver->notify((new PedidoDeAprovacao()));
    }
}
