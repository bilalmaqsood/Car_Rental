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

Route::post('/driver-and-vehicle-licensing-agency', 'ExternalRequestController');

Route::get('/terms/{type}', 'TermsController');

Route::post('/auth', '\Qwikkar\Http\Controllers\Auth\LoginController@login');

Route::post('/register/{type}', 'RegisterController');

Route::get('/search/{type}', 'SearchController');

Route::post('/forgot', '\Qwikkar\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('/contact', 'ContactController');

Route::get('vehicle/{id}', 'VehicleController@show');

Route::get('faq', 'FaqController@index');
Route::post('faq', 'FaqController@store');

Route::post('/time-slot/verify', 'TimeSlotController@verifySlots');

Route::post('/promo-code/verify', 'PromoCodeController');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/notifications', function (Request $request) {
        return api_response($request->user()->unreadNotifications);
    });
    Route::post('/notifications', function (Request $request) {
        $notification = Illuminate\Notifications\DatabaseNotification::find(request('notify_id'));
        if($notification)
            $notification->update(['read_at' => Carbon\Carbon::now()]);

    });

    Route::patch('faq/{id}', 'FaqController@update');

    Route::delete('faq/{id}', 'FaqController@destroy');

    Route::get('/user', 'AuthController@info');

    Route::patch('/profile/client', 'ProfileController@updateClient')->middleware('client');
    Route::patch('/profile/owner', 'ProfileController@updateOwner')->middleware('owner');

    Route::delete('/logout', '\Qwikkar\Http\Controllers\Auth\LoginController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('vehicle', 'VehicleController', ['except' => ['create', 'edit']]);
    Route::get('vehicle/{id}/contract-template', 'VehicleController@getContractTemplate');
    Route::post('vehicle/{id}/contract-template', 'VehicleController@contractTemplate');
    Route::post('vehicle/{id}/contract-signature', 'VehicleController@contractSignature');

    Route::post('/time-slot', 'TimeSlotController@addSlots');

    Route::resource('booking', 'BookingController', ['except' => ['create', 'edit']]);
    Route::post('booking/{id}/status', 'BookingController@updateStatusRequest');
    Route::patch('booking/{id}/status', 'BookingController@updateStatusFulfill');
    Route::post('booking/{id}/feedback', 'BookingController@giveFeedback');
    Route::get('booking/{id}/logs', 'BookingController@lastBookingLog')->middleware('owner');


    Route::post('credit-card/{id}/default', 'CreditCardController@defaultCard');
    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

    Route::post('/upload/{type}', 'UploadController');

    Route::get('/earnings', 'FinancialController@incomeDetail')->middleware('owner');
    Route::get('/booking/{id}/payment-weekly', 'FinancialController@paymentDetailWeekly')->middleware('not-admin');

    Route::resource('/booking/{booking_id}/inspection', 'InspectionController');

    Route::post('withdraw', 'WithdrawController');

    Route::post('update/device_id', 'AuthController@updateDeviceID')->middleware('not-admin');

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
