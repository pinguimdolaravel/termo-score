<?php

use App\Http\Livewire\SaveWordOfTheDay;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


#region Socialite Logins
Route::get('login/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('login.google.redirect');

Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::query()->firstOrCreate(['email' => $googleUser->email], [
        'name'     => $googleUser->name,
        'password' => bcrypt(Str::random(10)),
    ]);

    auth()->login($user);

    return redirect()->route('dashboard');
});

#endregion


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('can:admin')
    ->group(function () {
        Route::get('save-word-of-the-day', SaveWordOfTheDay::class)->name('save-word-of-the-day');
    });

require __DIR__ . '/auth.php';
