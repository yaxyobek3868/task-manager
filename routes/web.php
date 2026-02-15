<?php

use App\Http\Controllers\TaskHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login-by-email', [AuthController::class, 'showLoginByEmail'])->name('login-by-email');
    Route::post('/login-by-email', [AuthController::class, 'loginByEmail']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('index', [TaskController::class, 'index'])->name('index');
    Route::post('store', [TaskController::class, 'store'])->name('store');
    Route::get('detail/{task_id}', [TaskController::class, 'detail'])->name('detail');
});


Route::resource('task-history', TaskHistoryController::class);



Route::prefix('user')->name('user.')->group(function () {
    Route::get('index/{search?}', [UserController::class, 'index'])->name('index');
    Route::put('change-role/{user}', [UserController::class, 'changeRole'])->name('change-role');
    Route::put('change-status/{user}', [UserController::class, 'changeStatus'])->name('change-status');
});
