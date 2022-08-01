<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\Goal\IndexController;

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here are the routes using for only admin panel
|
*/

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'

], function ($router) {
    Route::group(['middleware' => ['auth','admin']], function () {
        Route::get('/update_profile', [App\Http\Controllers\Auth\ResetPasswordController::class,'index'])->name('change-password');
        Route::post('/update_password', [App\Http\Controllers\Auth\ResetPasswordController::class,'update_password'])->name('password_reset');
        Route::post('/update_username', [App\Http\Controllers\Auth\ResetPasswordController::class,'update_username'])->name('change-username');
        Route::get('/dashboard', [App\Http\Controllers\Admin\IndexController::class,'index'])->name('dashboard');

        Route::group(['prefix' => 'students','as' => 'students.'], function ($router) {
            Route::get('/', [App\Http\Controllers\Admin\Student\IndexController::class,'index'])->name('index');
            Route::get('/info/{id}', [App\Http\Controllers\Admin\Student\IndexController::class,'show'])->name('info');
        });
       
        Route::group(['prefix' => 'goals','as' => 'goals.'], function ($router) {
            Route::get('/', [App\Http\Controllers\Admin\Goal\IndexController::class,'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\Goal\IndexController::class,'create'])->name('create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\Goal\IndexController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\Goal\IndexController::class,'update'])->name('update');
            Route::post('/store', [App\Http\Controllers\Admin\Goal\IndexController::class,'store'])->name('store');
            Route::post('/destroy/{id}', [App\Http\Controllers\Admin\Goal\IndexController::class,'destroy'])->name('destroy');
        });
    });
});




