<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Country\CountryController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрируем API маршруты
            Route::prefix('api')->group(function () {
            Route::get('users', [UserController::class, 'show']);
            Route::get('user/{id}', [UserController::class, 'index']);
            Route::post('user', [UserController::class, 'store']);
            Route::put('user/{id}', [UserController::class, 'update']);
            Route::delete('user/{id}', [UserController::class, 'destroy']);
            Route::get('country', [CountryController::class, 'show']);
            Route::get('countries/{id}',[CountryController::class, 'index']);
            Route::post('store-country', [CountryController::class, 'store']);
            Route::put('update-country/{id}', [CountryController::class, 'update']);
            Route::delete('delete-country/{id}', [CountryController::class, 'destroy']);
        });
    }
}