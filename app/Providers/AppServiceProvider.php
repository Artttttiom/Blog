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
            Route::get('users', [UserController::class, 'users']);
            Route::get('user/{id}', [UserController::class, 'user']);
            Route::get('country', [CountryController::class, 'country']);
            Route::get('countries/{id}',[CountryController::class, 'countries']);
            Route::get('countries/{id}',[CountryController::class, 'index']);
            Route::post('store-country', [CountryController::class, 'store']);
            Route::put('update-country/{id}', [CountryController::class, 'update']);
            Route::delete('delete-country/{id}', [CountryController::class, 'destroy']);
        });
    }
}