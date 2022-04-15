<?php


use App\Http\Livewire\SaveWordOfTheDay;
use App\Models\WordOfDay;
use function Pest\Livewire\livewire;

it('should be able to save word of the day', function () {
    livewire(SaveWordOfTheDay::class)
        ->set('word', 'teste')
        ->set('word_confirmation', 'teste')
        ->set('game_id', 81)
        ->call('save')
        ->assertHasNoErrors();
});

test('word should be required', function () {
    livewire(SaveWordOfTheDay::class)
        ->call('save')
        ->assertHasErrors(['word' => 'required']);
});

test('word should have 5 letters', function () {
    livewire(SaveWordOfTheDay::class)
        ->set('word', 'test')
        ->set('word_confirmation', 'test')
        ->call('save')
        ->assertHasErrors(['word' => 'size']);
});

test('game_id should be required', function () {
    livewire(SaveWordOfTheDay::class)
        ->call('save')
        ->assertHasErrors(['game_id' => 'required']);
});

test('game_id should be unique', function () {
    WordOfDay::factory()->create(['game_id' => 81]);

    livewire(SaveWordOfTheDay::class)
        ->set('game_id', 81)
        ->call('save')
        ->assertHasErrors(['game_id' => 'unique']);
});
