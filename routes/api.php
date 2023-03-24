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

Route::group([

    'middleware' => 'api',
    'prefix' => 'role'

], function ($router) {

    Route::post('assign/{user}',   [\App\Http\Controllers\UserController::class,'assignRole']);
    Route::post('revoke/{user}',   [\App\Http\Controllers\UserController::class,'revokeRole']);

});

Route::apiResource('book', \App\Http\Controllers\BookController::class);
Route::apiResource('genre', \App\Http\Controllers\GenreController::class);
Route::apiResource('collection', \App\Http\Controllers\CollectionController::class);

