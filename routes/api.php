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

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/user', 'AuthController@info');

    Route::delete('/logout', 'AuthController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('vehicle', 'VehicleController', ['except' => ['create', 'edit']]);
    Route::resource('booking', 'BookingController', ['except' => ['create', 'edit']]);
    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

    Route::post('/time-slot', 'TimeSlotController');

    Route::post('/upload/{type}', 'UploadController');

    Route::get('/search/{type}', 'SearchController');


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
