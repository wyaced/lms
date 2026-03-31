<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::controller(StudentController::class)->group(function () {
    Route::get('/students', 'index')->name('students.index');
    Route::get('/students/create', 'create')->name('students.create');
    Route::post('/students', 'store')->name('students.store');
    Route::get('/students/{id}', 'show')->name('students.show');
    Route::get('/students/{id}/edit', 'edit')->name('students.edit');
    Route::put('/students/{id}', 'update')->name('students.update');
    Route::delete('/students/{id}', 'destroy')->name('students.destroy');
});