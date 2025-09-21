<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;


Route::get('/', function () {
    return view('welcome');
});



// Redirection Endpoint
Route::get('/{short_code}', [UrlController::class, 'redirect']);