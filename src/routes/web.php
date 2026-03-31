<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/bkt.php';
require __DIR__.'/question-responses.php';
require __DIR__.'/settings.php';
require __DIR__.'/students.php';