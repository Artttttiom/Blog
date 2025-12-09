<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\EmployeeController\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::post('register', [RegisterController::class, 'register']);
Route::post('verify', [VerificationController::class, 'verify']);
Route::post('verify/resend', [VerificationController::class, 'resend']);
Route::post('login', [LoginController::class, 'login']);

//Employees
Route::post('create-employee', [EmployeeController::class, 'store']);
Route::get('employees', [EmployeeController::class, 'index']);
Route::get('categories', [EmployeeController::class, 'getCategories']);
Route::get('gender', [EmployeeController::class, 'getUsersWithGender']);




