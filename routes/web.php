<?php

use App\Http\Controllers\RafaelController;
use App\Http\Controllers\TioJobsController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'users' => User::all()
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('users/{user}', [UserController::class, 'show'])->name('user.show');

Route::get('tio-jobs', TioJobsController::class)->name('tio-jobs')
    ->middleware('can:tio-jobs');
Route::get('rafael', RafaelController::class)->name('rafael');

require __DIR__ . '/auth.php';
