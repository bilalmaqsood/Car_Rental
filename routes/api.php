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

Route::post('/auth', '\Qwikkar\Http\Controllers\Auth\LoginController@login');

Route::post('/register/{type}', 'RegisterController');

Route::get('/search/{type}', 'SearchController');

Route::post('/forgot', '\Qwikkar\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('/contact', 'ContactController');

Route::get('vehicle/{id}', 'VehicleController@show');

Route::get('faq', 'FaqController@index');
Route::post('faq', 'FaqController@store');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/notifications', function (Request $request) {
        return api_response($request->user()->notifications);
    });

    Route::patch('faq/{id}', 'FaqController@update');

    Route::delete('faq/{id}', 'FaqController@destroy');

    Route::get('/user', 'AuthController@info');

    Route::patch('/profile/client', 'ProfileController@updateClient')->middleware('client');
    Route::patch('/profile/owner', 'ProfileController@updateOwner')->middleware('owner');

    Route::delete('/logout', '\Qwikkar\Http\Controllers\Auth\LoginController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('vehicle', 'VehicleController', ['except' => ['create', 'edit']]);

    Route::post('/time-slot', 'TimeSlotController');

    Route::resource('booking', 'BookingController', ['except' => ['create', 'edit']]);
    Route::post('booking/{id}/status', 'BookingController@updateStatusRequest');
    Route::patch('booking/{id}/status', 'BookingController@updateStatusFulfill');

    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

    Route::post('/upload/{type}', 'UploadController');

    Route::get('/earnings', 'FinancialController@incomeDetail')->middleware('owner');
    Route::get('/booking/{id}/payment-weekly', 'FinancialController@paymentDetailWeekly')->middleware('not-admin');

    Route::resource('/booking/{booking_id}/inspection', 'InspectionController');

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
