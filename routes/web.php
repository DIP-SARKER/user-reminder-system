<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;

Route::view('/', 'welcome')->name('welcome');


Route::middleware('auth')->group(function () {


    //user space
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');
    Route::view('profile', 'profile')
        ->name('profile');

    //admin space
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');

    });

});

require __DIR__ . '/auth.php';
