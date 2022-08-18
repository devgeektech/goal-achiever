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
            Route::post('/update_doc', [App\Http\Controllers\Admin\Goal\IndexController::class,'update_doc'])->name('update-doc');
            Route::post('/destroy/{id}', [App\Http\Controllers\Admin\Goal\IndexController::class,'destroy'])->name('destroy');
            Route::post('/get_units', [App\Http\Controllers\Admin\Goal\IndexController::class,'get_units'])->name('get_units');
            Route::post('/get_topics', [App\Http\Controllers\Admin\Goal\IndexController::class,'get_topics'])->name('get_topics');
            Route::post('/update_image', [App\Http\Controllers\Admin\Goal\IndexController::class,'update_image'])->name('update_image');
            
            
        });

        Route::group(['prefix' => 'plans','as' => 'plans.'], function ($router) {
            Route::get('/', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'create'])->name('create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'update'])->name('update');
            Route::post('/store', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'store'])->name('store');
            Route::post('/destroy/{id}', [App\Http\Controllers\Admin\MembershipPlan\IndexController::class,'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'units','as' => 'units.'], function ($router) {
            Route::get('/', [App\Http\Controllers\Admin\Unit\IndexController::class,'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\Unit\IndexController::class,'create'])->name('create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\Unit\IndexController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\Unit\IndexController::class,'update'])->name('update');
            Route::post('/store', [App\Http\Controllers\Admin\Unit\IndexController::class,'store'])->name('store');
            Route::post('/destroy/{id}', [App\Http\Controllers\Admin\Unit\IndexController::class,'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'topics','as' => 'topics.'], function ($router) {
            Route::get('/', [App\Http\Controllers\Admin\Topic\IndexController::class,'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\Admin\Topic\IndexController::class,'create'])->name('create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\Topic\IndexController::class,'edit'])->name('edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\Topic\IndexController::class,'update'])->name('update');
            Route::post('/store', [App\Http\Controllers\Admin\Topic\IndexController::class,'store'])->name('store');
            Route::post('/destroy/{id}', [App\Http\Controllers\Admin\Topic\IndexController::class,'destroy'])->name('destroy');
        });
        
    });
});




