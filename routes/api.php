<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/terms/{type}', 'TermsController');

Route::post('/auth', 'AuthController@login');
Route::post('/register/{type}', 'RegisterController@index');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', 'AuthController@info');

    Route::delete('/logout', 'AuthController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

});
