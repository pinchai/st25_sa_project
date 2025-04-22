<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('/register-product', function () {
    return view('register_product');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/product', [\App\Http\Controllers\ProductController::class, 'index']);
Route::post('/do-register-product', [\App\Http\Controllers\ProductController::class, 'createProduct']);
Route::get('/confirm-delete', [\App\Http\Controllers\ProductController::class, 'confirmDelete']);
Route::get('/do-delete', [\App\Http\Controllers\ProductController::class, 'doDelete']);
Route::get('/get-edit', [\App\Http\Controllers\ProductController::class, 'getEdit']);
Route::post('/do-edit', [\App\Http\Controllers\ProductController::class, 'doEdit']);
