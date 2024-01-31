<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpensesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['message' => 'API is running...'];
});

Route::post('auth/login', [AuthController::class, 'login']);
Route::get('auth/me', [AuthController::class, 'me'])->middleware('jwt.auth');
Route::post('auth/refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
Route::resource('expenses', ExpensesController::class)->middleware('jwt.auth');
