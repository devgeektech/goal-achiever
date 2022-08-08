<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\Goal\IndexController;

/*
|--------------------------------------------------------------------------
| Web Student Routes
|--------------------------------------------------------------------------
|
| Here are the routes using for only admin panel
|
*/

Route::group([
    'prefix' => 'student',
    'as' => 'student.'

], function ($router) {
    Route::group(['middleware' => ['auth','student']], function () {
        Route::get('/dashboard', [App\Http\Controllers\Student\IndexController::class,'index'])->name('dashboard');
        Route::get('/update_profile', [App\Http\Controllers\Auth\ResetPasswordController::class,'index'])->name('change-password');
        Route::post('/update_password', [App\Http\Controllers\Auth\ResetPasswordController::class,'update_password'])->name('password_reset');
        Route::post('/update_username', [App\Http\Controllers\Auth\ResetPasswordController::class,'update_username'])->name('change-username');
    });
    Route::group(['prefix' => 'goals','as' => 'goals.'], function ($router) {
        Route::get('/', [App\Http\Controllers\Student\Goal\IndexController::class,'index'])->name('index');
        Route::get('/info/{id}', [App\Http\Controllers\Student\Goal\IndexController::class,'show'])->name('info');
        Route::get('/download/{filename}', [App\Http\Controllers\Student\Goal\IndexController::class,'doc_download'])->name('download');
    });
    Route::group(['prefix' => 'plans','as' => 'plans.'], function ($router) {
        Route::get('/', [App\Http\Controllers\Student\Plans\IndexController::class,'index'])->name('index');
        Route::get('/info/{id}', [App\Http\Controllers\Student\Plans\IndexController::class,'show'])->name('info');
        Route::post('/store', [App\Http\Controllers\Student\Plans\IndexController::class,'store'])->name('store');
    });
   
});




