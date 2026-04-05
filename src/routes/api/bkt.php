<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BktController;

Route::controller(BktController::class)->group(function () {
    Route::post('/mastery-batch-update-callback','masteryBatchUpdateCallback')->name('mastery-batch-update-callback');
});