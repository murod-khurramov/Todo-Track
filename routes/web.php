<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('error', [UserController::class, 'error'])->name('error');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard',[TaskController::class,'index'])->name('dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('tasks/{id}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
