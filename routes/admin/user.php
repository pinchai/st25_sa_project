<?php
Route::get('/admin/user', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/admin/add-user', [\App\Http\Controllers\UserController::class, 'addUser']);
Route::get('/admin/get-user', [\App\Http\Controllers\UserController::class, 'getUser']);
Route::post('/admin/delete-user', [\App\Http\Controllers\UserController::class, 'deleteUser']);
Route::post('/admin/edit-user', [\App\Http\Controllers\UserController::class, 'editUser']);
