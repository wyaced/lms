<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BktController;

Route::controller(BktController::class)->group(function () {
    Route::get('/train-bkt', 'trainBkt')->name('train-bkt');
    Route::get('/mastery-records','indexMasteryRecords')->name('mastery-records.index');
    Route::get('/init-masteries','initMasteries')->name('init-masteries');
    Route::get('/update-mastery-records','updateMasteryRecords')->name('update-mastery-records');
});