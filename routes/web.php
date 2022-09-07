<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SendEmailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\IndexController::class,'index'])->name('index');
//Auth::routes();
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class,'register'])->name('register');
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
Route::post('contact', [App\Http\Controllers\IndexController::class,'contact'])->name('contact');

Route::get('/goals', [App\Http\Controllers\Web\Goals\IndexController::class,'goals'])->name('goals');
Route::get('/info/{id}', [App\Http\Controllers\Web\Goals\IndexController::class,'show'])->name('info');
Route::get('/description/{id}', [App\Http\Controllers\Web\Goals\IndexController::class,'description'])->name('description');

Route::post('/payment-store', [App\Http\Controllers\Auth\RegisterController::class,'paymentStore'])->name('payment_store');
Route::post('/check_auth', [App\Http\Controllers\Auth\RegisterController::class,'check_auth'])->name('check_auth');

Route::post('getBarGraphData', [App\Http\Controllers\IndexController::class,'getBarGraphData'])->name('getBarGraphData');