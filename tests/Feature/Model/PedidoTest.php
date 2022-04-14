<?php


use App\Events\PedidoUpdatedEvent;
use App\Mail\EmailQualquerMail;
use App\Models\Pedido;

test('um evento precisa ser disparado quando atualizar o pedido', function () {

    Event::fake();

    $pedido = Pedido::query()->create(['estado' => 'show']);

    Event::assertNotDispatched(PedidoUpdatedEvent::class);

    $pedido->estado = 'outra estado';
    $pedido->save();

    Event::assertDispatched(PedidoUpdatedEvent::class);
});

test('preciso mandou um caso se o estado mudar', function () {

    Mail::fake();

    $pedido = Pedido::query()->create(['estado' => 'show']);

    Mail::assertNothingSent();
    $pedido->estado = 'show';
    $pedido->save();
    Mail::assertNothingSent();

    $pedido->estado = 'outra estado';
    $pedido->save();
    Mail::assertSent(EmailQualquerMail::class);
});
