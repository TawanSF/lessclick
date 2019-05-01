<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/gallery', 'GalleryController@show')->name('gallery');
Route::post('/gallery', 'GalleryController@store')->name('store-gallery');
Route::delete('/gallery/{id}', 'GalleryController@destroy')->name('destroy-gallery');
Route::get('/gallery/download/{id}', 'GalleryController@download')->name('download-gallery');

Route::get('/administrator/register', 'Auth\RegisterController@register');
Route::post('/administrator/register', 'Auth\RegisterController@store');
Route::get('/administrator/list', 'Auth\RegisterController@index');
Route::get('/administrator/list/{id}', 'Auth\RegisterController@show');
Route::get('/administrator/update/{id}', 'Auth\RegisterController@update');
Route::delete('/administrator/list/{id}', 'Auth\RegisterController@destroy');
// Route::update('/administrator/update/{id}', 'Auth\RegisterController@update');


Route::get('/administrator', 'AdministratorController@index')->name('administrator.dashboard');
Route::get('/administrator/login', 'Auth\AdministratorLoginController@index')->name('administrator.login');
Route::post('/administrator/login', 'Auth\AdministratorLoginController@login')->name('administrator.login.submit');
