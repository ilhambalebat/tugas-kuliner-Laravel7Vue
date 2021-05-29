<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', 'Auth\MeController');

    Route::prefix('posts')->namespace('Posts')->group(function () {
        Route::get('', 'PostController@index')->withoutMiddleware('auth:sanctum');

        Route::post('create', 'PostController@store');
        Route::patch('{post:slug}/edit', 'PostController@update');
        Route::delete('{post:slug}/delete', 'PostController@destroy');

        Route::get('subjects/{subject:slug}', 'SubjectController@show')->withoutMiddleware('auth:sanctum');
        Route::get('{subject:slug}/{post:slug}', 'PostController@show')->withoutMiddleware('auth:sanctum');
    });
});
