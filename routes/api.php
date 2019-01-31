<?php

use Illuminate\Http\Request;
















Route::post('/user/login', 'AuthController@login');
Route::post('/user/register', 'AuthController@register');