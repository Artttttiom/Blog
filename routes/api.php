<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Country\CountryController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Counties
Route::get('country', [CountryController::class, 'index']);
Route::get('countries/{id}',[CountryController::class, 'show']);
Route::post('store-country', [CountryController::class, 'store']);
Route::put('update-country/{id}', [CountryController::class, 'update']);
Route::delete('delete-country/{id}', [CountryController::class, 'destroy']);

//Users
Route::get('users', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('user', [UserController::class, 'store']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'destroy']);
Route::get('roles', [UserController::class, 'indexRole']);

//Articles
Route::get('articles',[ArticleController::class, 'index']);
Route::get('article/{id}',[ArticleController::class,'show']);
Route::post('article',[ArticleController::class, 'store']);
Route::put('article/{id}', [ArticleController::class, 'update']);
Route::delete('article/{id}',[ArticleController::class, 'destroy']); 