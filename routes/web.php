<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    //
    Route::get('/user-manager', \App\Livewire\UserManager::class)->name('user-manager');
    // Route::get('/user-manager/{user}', \App\Livewire\UserManager::class)->name('user-manager.user');
    // Route::get('/user-manager/{user}/edit', \App\Livewire\UserManager::class)->name('user-manager.user.edit');
    // Route::get('/user-manager/{user}/delete', \App\Livewire\UserManager::class)->name('user-manager.user.delete');
    // Route::get('/user-manager/{user}/reset-password', \App\Livewire\UserManager::class)->name('user-manager.user.reset-password');
});

require __DIR__.'/auth.php';
Route::get('/user-manager', \App\Livewire\UserManager::class)->name('user-manager');