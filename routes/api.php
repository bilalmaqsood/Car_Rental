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

Route::post('/auth', 'RegisterController@login');
Route::post('/register/{type}', 'RegisterController@index');

Route::group(['middleware' => 'auth:api'], function () {

    Route::post('/user', function (Request $request) {
        return api_response($request->user());
    });

//    Route::post('/token', function (Request $request) {
//        $user = Qwikkar\Models\User::find(1);
//        $token = $user->createToken('NewGeneratedToken')->accessToken;
//        return api_response($token);
//    });

});
