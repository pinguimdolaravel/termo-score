<?php

use App\Http\Livewire\Groups;
use App\Http\Livewire\SaveWordOfTheDay;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('groups', Groups\Index::class)->name('groups.index')
    ->middleware('auth');

Route::middleware('can:admin')
    ->group(function () {
        Route::get('save-word-of-the-day', SaveWordOfTheDay::class)->name('save-word-of-the-day');
    });

require __DIR__ . '/auth.php';
