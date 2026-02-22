<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminTaskController;
use Illuminate\Support\Facades\Route;






Route::match(['GET', 'POST'], '/', [LoginController::class, 'login'])->name('login.submit');
// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('home')->name('home.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::post('/task/{uuid}/status', [HomeController::class, 'updateTaskStatus'])->name('task.status.update');
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'companyCheck'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [AdminProjectController::class, 'index'])->name('index');
        Route::post('/', [AdminProjectController::class, 'store'])->name('store');
        Route::put('/{id}', [AdminProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminProjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [AdminTaskController::class, 'index'])->name('index');
        Route::post('/', [AdminTaskController::class, 'store'])->name('store');
        Route::put('/{id}', [AdminTaskController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminTaskController::class, 'destroy'])->name('destroy');
    });
});

// Route::prefix('project')->name('project.')->group(function () {
//     Route::post('add', [ProjectController::class, 'addProject'])->name('add');
//     Route::post('update/{uuid}', [ProjectController::class, 'update'])->name('update');
//     Route::get('delete/{uuid}', [ProjectController::class, 'delete'])->name('delete');
// });
// Route::prefix('task')->name('task.')->group(function () {
//     Route::post('add', [TaskController::class, 'addTask'])->name('add');
//     Route::post('update/{uuid}', [TaskController::class, 'updateTask'])->name('update');
//     Route::get('delete/{uuid}', [TaskController::class, 'delete'])->name('delete');
//     Route::post('status/{uuid}', [TaskController::class, 'statusUpdate'])->name('status');
// });
