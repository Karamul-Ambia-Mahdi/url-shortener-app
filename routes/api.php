<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



// Authentication API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



// Protected API
Route::middleware(['token'])->group(function () {

    Route::get('/urls', function () {
        return "You are authorized. WELCOME HERE !!!";
    });
    Route::post('/shorten', function () {
        return "You are authorized. WELCOME HERE !!!";
    });
});
