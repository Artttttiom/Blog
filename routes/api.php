<?php

use App\Http\Controllers\Country\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users', 'User\UserController@users');
Route::get('user/{id}', 'User\UserController@user');
Route::get('country', [CountryController::class, 'country']);
Route::get('countries/{id}',[CountryController::class, 'countries']);