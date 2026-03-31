<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionResponseController;

Route::controller(QuestionResponseController::class)->group(function () {
    Route::get('/question-responses', 'index')->name('question-responses.index');
    Route::get('/question-responses/create', 'create')->name('question-responses.create');
    Route::post('/question-responses', 'store')->name('question-responses.store');
    Route::get('/question-responses/{id}', 'show')->name('question-responses.show');
    Route::get('/question-responses/{id}/edit', 'edit')->name('question-responses.edit');
    Route::put('/question-responses/{id}', 'update')->name('question-responses.update');
    Route::delete('/question-responses/{id}', 'destroy')->name('question-responses.destroy');
});