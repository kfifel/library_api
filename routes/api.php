<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login',   [AuthController::class,'login']);
    Route::post('logout',  [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me',      [AuthController::class,'me']);

});

Route::apiResource('book', \App\Http\Controllers\BookController::class);
Route::apiResource('genre', \App\Http\Controllers\GenreController::class);
Route::apiResource('collection', \App\Http\Controllers\CollectionController::class);
