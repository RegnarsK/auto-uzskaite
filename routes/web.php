<?php
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
//     Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasks.index');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'userTasks'])->name('tasks.index');
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
});
// Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
//     Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasks.index');
// });

require __DIR__.'/auth.php';
