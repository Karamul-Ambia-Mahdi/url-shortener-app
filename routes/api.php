<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



// Authentication API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// Protected API
Route::middleware(['token'])->group(function () {

    Route::get('/urls', [UrlController::class, 'index']);
    Route::post('/shorten', [UrlController::class, 'shorten']);
});