<?php

//use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Permissions\RolePermissions;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {

    Route::post('login',   [AuthController::class,'login']);
    Route::post('logout',  [AuthController::class,'logout']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me',      [AuthController::class,'me']);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'role'

], function ($router) {

    Route::post('assign',   [UserController::class,'assignRole'])
        ->middleware('permission:'.RolePermissions::ASSIGN_ROLE);

    Route::post('revoke',   [UserController::class,'revokeRole'])
        ->middleware('permission:'.RolePermissions::REVOKE_ROLE);

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'password'

], function ($router) {

    Route::post('forget',   [AuthController::class,'forgotPassword']);
    Route::post('reset',   [AuthController::class,'resetPassword'])->name('password.reset');

});

Route::apiResource('book', \App\Http\Controllers\BookController::class);
Route::apiResource('genre', \App\Http\Controllers\GenreController::class);
Route::apiResource('collection', \App\Http\Controllers\CollectionController::class);

