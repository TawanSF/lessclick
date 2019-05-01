<?php

use Illuminate\Http\Request;

Route::prefix('auth')->group(function () {
    Route::post('v1/register', 'AuthenticateController@register')->name('api.register');
    Route::post('v1/login', 'AuthenticateController@login')->name('api.login');
    Route::middleware('auth:api')->group(function () {
        Route::post('v1/logout', 'AuthenticateController@logout')->name('api.logout');
    });
});

Route::post('v1/users', 'ApiControllers\UserController@create')->name('api.create-user');
Route::get('v1/users', 'ApiControllers\UserController@getAll')->name('api.get-all-users');
Route::get('v1/users/{id}', 'ApiControllers\UserController@getUnique')->name('api.get-unique-user');
Route::put('v1/users/{id}', 'ApiControllers\UserController@update')->name('api.update-user');
Route::delete('v1/users/{id}', 'ApiControllers\UserController@delete')->name('api.delete-user');
