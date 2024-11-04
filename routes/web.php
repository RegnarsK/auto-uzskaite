<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\UserTaskController;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/cars', CarController::class);
    Route::resource('admin/tasks', TaskController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('tasks', [UserTaskController::class, 'index'])->name('tasks.index');
    Route::post('tasks/{task}/assign', [UserTaskController::class, 'assign'])->name('tasks.assign');
    Route::post('tasks/{task}/complete', [UserTaskController::class, 'complete'])->name('tasks.complete');
});
