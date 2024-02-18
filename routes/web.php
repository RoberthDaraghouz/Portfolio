<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('dashboard', 'admin.dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('portfolio', 'admin.portfolio')->middleware(['auth', 'verified'])->name('portfolio');
Route::view('profile', 'admin.profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
