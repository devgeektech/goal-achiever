<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Goal\IndexController;
/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here are the routes using for only admin panel
|
*/

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/students', function () {
    return view('admin.student.index');
});

Route::resource('goals', IndexController::class);