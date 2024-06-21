<?php

use App\Livewire\Chat;
use App\Livewire\Chat\Browse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/browse', Browse::class)->name('browse');
    Route::get('/chat/{id?}', Chat::class)->name('chat');
});
