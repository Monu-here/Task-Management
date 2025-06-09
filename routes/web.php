<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/', [HomeController::class, 'home'])->name('home');
Route::prefix('project')->name('project.')->group(function () {
    Route::post('add', [ProjectController::class, 'addProject'])->name('add');
    Route::post('update/{uuid}', [ProjectController::class, 'update'])->name('update');
    Route::get('delete/{uuid}', [ProjectController::class, 'delete'])->name('delete');
});
Route::prefix('task')->name('task.')->group(function () {
    Route::post('add', [TaskController::class, 'addTask'])->name('add');
    Route::post('update/{uuid}', [TaskController::class, 'updateTask'])->name('update');
    Route::get('delete/{uuid}', [TaskController::class, 'delete'])->name('delete');
    Route::post('status/{uuid}', [TaskController::class, 'statusUpdate'])->name('status');
});
