<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use Illuminate\Support\Facades\Route;


Route::post('register', [RegisterController::class, 'register']);
Route::post('verify', [VerificationController::class, 'verify']);
Route::post('verify/resend', [VerificationController::class, 'resend']);
Route::post('login', [LoginController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user', [LoginController::class, 'user']);
});

