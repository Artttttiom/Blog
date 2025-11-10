<?php

use App\Http\Controllers\Country\CountryController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('country', [CountryController::class, 'show']);
Route::get('countries/{id}',[CountryController::class, 'index']);
Route::post('store-country', [CountryController::class, 'store']);
Route::put('update-country/{id}', [CountryController::class, 'update']);
Route::delete('delete-country/{id}', [CountryController::class, 'destroy']);
Route::get('users', [UserController::class, 'show']);
Route::get('user/{id}', [UserController::class, 'index']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);