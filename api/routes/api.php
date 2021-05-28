<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', 'Auth\MeController');

    Route::prefix('posts')->namespace('Posts')->group(function () {
        Route::get('', 'PostController@index')->withoutMiddleware('auth:sanctum');
        Route::get('{post:slug}', 'PostController@show')->withoutMiddleware('auth:sanctum');
        Route::get('subjects/{subject:slug}', 'SubjectController@show')->withoutMiddleware('auth:sanctum');
    });
});
