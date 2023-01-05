<?php

use ArtMin96\FilamentTributeJs\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->group(function () {
        Route::get('/mention/users', [UserController::class, 'mention']);
    });
