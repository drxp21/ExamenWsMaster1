<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', function () {
    return User::all();
})->name('user');
Route::get('users', [UserController::class, 'index']);
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::controller(TaskController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('tasks',  'index');
    Route::post('tasks',  'store');
    Route::get('tasks/{id}',  'show');
    Route::put('tasks/{id}',  'update');
    Route::delete('tasks/{id}',  'destroy');
    Route::put('tasks/{id}/toggle-status',  'toggle_status');
    Route::get('finished', 'finished_tasks');
    Route::get('pending', 'pending_tasks');
});
