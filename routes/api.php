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
Route::post('/register/{type}', 'RegisterController');

Route::get('/search/{type}', 'SearchController');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', 'AuthController@info');

    Route::patch('/profile/client', 'ProfileController@updateClient')->middleware('client');
    Route::patch('/profile/owner', 'ProfileController@updateOwner')->middleware('owner');

    Route::delete('/logout', 'AuthController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('vehicle', 'VehicleController', ['except' => ['create', 'edit']]);

    Route::resource('booking', 'BookingController', ['except' => ['create', 'edit']]);
    Route::post('booking/{id}/status', 'BookingController@updateStatusRequest');
    Route::patch('booking/{id}/status', 'BookingController@updateStatusFulfill');

    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

    Route::post('/upload/{type}', 'UploadController');

    /**
     * Contracts
     */
    Route::get('contract/{id}/pdf', function ($id) {
        return PDF::loadView('pdf.contract', ['id' => $id, 'sign' => '', 'name' => 'oknasir'])->download("contract-{$id}.pdf");
    })->middleware('not-admin');

    Route::post('contract/{id}/sign', function ($id, Request $request) {
        return PDF::loadView('pdf.contract', [
            'id' => $id,
            'name' => 'oknasir',
            'sign' => $request->hasFile('sign') ? $request->sign->store('signatures') : ''
        ])->download("contract-{$id}.pdf");
    })->middleware('owner');

});
