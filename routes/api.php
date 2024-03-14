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
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::controller(TaskController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('tasks', 'index');
    Route::post('tasks/store', 'store');
    Route::put('tasks/update/{id}', 'update');
    Route::delete('tasks/destroy/{id}', 'destroy');
    Route::get('find-my-tasks', 'findMyTask');
    Route::post('logout', 'logout');
});
