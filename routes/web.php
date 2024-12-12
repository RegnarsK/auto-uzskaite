<?php
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Worker routes
Route::middleware('auth')->group(function () {
    // Available tasks
    Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasks.index');
    // My tasks
    Route::get('/my-tasks', [UserTaskController::class, 'myTasks'])->name('tasks.my-tasks');
    // Task actions
    Route::post('/tasks/{task}/assign', [UserTaskController::class, 'assign'])->name('tasks.assign');
    Route::post('/tasks/{task}/complete', [UserTaskController::class, 'complete'])->name('tasks.complete');
});

// Admin routes
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // Car management
    Route::resource('cars', CarController::class);
    
    // Task management
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
