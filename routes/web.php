<?php

use App\Http\Controllers\TaskHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\Auth\EmailLoginController;


Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
//    Route::get('/login-by-email', [AuthController::class, 'showLoginByEmail'])->name('login-by-email');
//    Route::post('/login-by-email', [AuthController::class, 'loginByEmail']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/', function () {
        return redirect()->route('login');
    });
});


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('tasks.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('tasks')->name('tasks.')->group(function () {

        Route::get('index/{status?}', [TaskController::class, 'index'])
            ->name('index')
            ->where('status', '^[123]$');

        Route::post('store', [TaskController::class, 'store'])
            ->name('store')
            ->middleware('isAdmin');

        Route::get('detail/{task_id}', [TaskController::class, 'detail'])
            ->name('detail');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
        Route::put('detail/{id}', [TaskController::class, 'update'])->name('tasks.update');

        Route::post('/comment/{id}', [TaskController::class, 'comment'])->name('comment');
        Route::patch('detail/{id}/status', [TaskController::class, 'updateStatus'])
            ->name('updateStatus');

    });



    Route::resource('task-history', TaskHistoryController::class);
    Route::get('/task-history', [TaskHistoryController::class, 'index'])
        ->name('task-history.index');


    Route::prefix('user')
        ->name('user.')
        ->middleware('isAdmin')
        ->group(function () {

            Route::get('index/{search?}', [UserController::class, 'index'])
                ->name('index');

            Route::patch('change-role/{user}', [UserController::class, 'changeRole'])
                ->name('change-role');

            Route::patch('change-status/{user}', [UserController::class, 'changeStatus'])
                ->name('change-status');

            Route::get('{user}/edit', [UserController::class, 'edit'])
                ->name('edit');

            Route::put('{user}', [UserController::class, 'update'])
                ->name('update');

            Route::delete('{user}', [UserController::class, 'destroy'])
                ->name('destroy');
        });

});
