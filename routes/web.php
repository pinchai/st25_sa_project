<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])
    ->name('login');
Route::post('/do-login', [\App\Http\Controllers\LoginController::class, 'doLogin']);
include('front/front.php');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
    //admin block
    include('admin/dashboard.php');
    include('admin/user.php');
});
