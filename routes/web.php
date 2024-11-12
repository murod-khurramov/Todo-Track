<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// User authentication routes
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('error', [UserController::class, 'error'])->name('error');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');

// Authenticated routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // Task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Route for editing a task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update'); // Route for updating a task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('tasks/{id}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');

    // Logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
