<?php

use App\Http\Livewire\SaveWordOfTheDay;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


#region Socialite Logins
Route::get('login/{driver}/redirect', function ($driver) {

    Validator::validate(compact('driver'), ['driver' => 'required|in:google,github']);

    return Socialite::driver($driver)->redirect();
})->name('auth.social.redirect');

Route::get('auth/{driver}/callback', function ($driver) {
    $socialUser = Socialite::driver($driver)->stateless()->user();

    $user = User::query()->firstOrCreate(['email' => $socialUser->email], [
        'name'     => $socialUser->name,
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
