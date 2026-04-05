<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasteryBatchUpdateLogsController;

Route::controller(MasteryBatchUpdateLogsController::class)->group(function () {
    Route::post('/mastery-batch-update-callback','masteryBatchUpdateCallback')->name('mastery-batch-update-callback');
});