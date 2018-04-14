<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('welcome');
})->name('login');

Route::post('/login', 'AuthController@auth_user');
Route::post('/login/auth_token', 'AuthController@auth_token');


