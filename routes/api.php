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

Route::post('/validate/register/{type}', 'ValidationController@registerValidate');

Route::get('/search/{type}', 'SearchController');

Route::post('/forgot', '\Qwikkar\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');

Route::post('/contact', 'ContactController');

Route::get('vehicle/{id}', 'VehicleController@show');

Route::get('faq', 'FaqController@index');
Route::post('faq', 'FaqController@store');

Route::post('/time-slot/verify', 'TimeSlotController@verifySlots');

Route::get('/promo-code/{code}', 'PromoCodeController@info');
Route::post('/promo-code/verify', 'PromoCodeController@verify');

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('message', 'MessageController@allMessages');
    Route::get('message/{id}', 'MessageController@getMessages');
    Route::post('message/read', 'MessageController@markRead');
    Route::post('message/send', 'MessageController@sendMessage');
    Route::get('message/{user_id}/get', 'MessageController@getUserMessages');
    Route::get('message/{user_id}/recent', 'MessageController@getNewMessages');

    Route::patch('faq/{id}', 'FaqController@update');

    Route::delete('faq/{id}', 'FaqController@destroy');

    Route::get('/user', 'AuthController@info');
    Route::post('/change-password', 'AuthController@changePassword');

    Route::get('/notifications', 'AuthController@notifications');
    Route::post('/notifications', 'AuthController@notificationsRead');

    Route::get('/booking/{id}/user-profile','ProfileController@showProfile')->middleware('owner');
    Route::patch('/profile/client', 'ProfileController@updateClient')->middleware('client');
    Route::patch('/profile/owner', 'ProfileController@updateOwner')->middleware('owner');

    Route::delete('/logout', '\Qwikkar\Http\Controllers\Auth\LoginController@logout');

    Route::resource('account', 'AccountController', ['except' => ['create', 'edit']]);
    Route::resource('vehicle', 'VehicleController', ['except' => ['create', 'edit']]);
    Route::get('vehicle/{id}/contract-template', 'ContractController@getContractTemplate');
    Route::post('vehicle/{id}/contract-signature', 'ContractController@contractSignature');
    Route::post('vehicle/{id}/contract-template', 'ContractController@contractTemplate');
    Route::get('booking/{id}/contract', 'ContractController@contractBooking');
    Route::get('booking/{id}/contract-data', 'ContractController@contractData');
    Route::patch('booking/{id}/contract-data', 'ContractController@updateContractData');
    Route::post('booking/{id}/preview-contract', 'ContractController@previewContract');

    Route::post('/time-slot', 'TimeSlotController@addSlots');
    Route::get('/vehicle/{id}/time-slot', 'TimeSlotController@getSlots');
    Route::get('/booking/{id}/time-slots', 'TimeSlotController@getBookedSlots');

    Route::resource('booking', 'BookingController', ['except' => ['create', 'edit']]);
    Route::post('booking/{id}/pickup-timeslot', 'BookingController@pickupTimeslot');
    Route::post('booking/{id}/status', 'BookingController@updateStatusRequest');
    Route::delete('booking/{id}/cancel-request', 'BookingController@cancelRequest');
    Route::patch('booking/{id}/status', 'BookingController@updateStatusFulfill');
    Route::post('booking/{id}/feedback', 'BookingController@giveFeedback');
    Route::get('booking/{id}/logs', 'BookingController@lastBookingLog')->middleware('owner');
    Route::post('booking/{id}/signature', 'BookingController@signatureBooking')->middleware('not-admin');
    Route::post('booking/{id}/weekly-mileage', 'BookingController@weeklyMileageService')->middleware('client');


    Route::post('credit-card/{id}/default', 'CreditCardController@defaultCard');
    Route::resource('credit-card', 'CreditCardController', ['except' => ['create', 'edit']]);

    Route::post('/upload/{type}', 'UploadController');

    Route::get('/earnings', 'FinancialController@incomeDetail')->middleware('owner');
    
    Route::get('/current-balance', 'FinancialController@balanceDetails')->middleware('client');

    Route::get('/booking/{id}/payment-weekly', 'FinancialController@paymentDetailWeekly')->middleware('not-admin');

    Route::post('/booking/{id}/pay-overdue','FinancialController@payOverdueAmount');

    Route::get('/vehicle/{vehicle_id}/inspection', 'InspectionController@lastInspection');

    Route::patch('/booking/{booking_id}/approve-inspection/{spot_id}', 'InspectionController@approveInspection');

    Route::patch('/booking/{booking_id}/resolve-inspection/{spot_id}', 'InspectionController@resolveDisputedSpot');

    Route::post('/booking/{booking_id}/notify-driver', 'InspectionController@notifyDriver');

    Route::post('/booking/{booking_id}/notify-amendedInspection', 'InspectionController@notifyAmendedInspection');

    Route::post('/booking/{booking_id}/confirm-inspection', 'InspectionController@confirmInspection');

    Route::post('/booking/{booking_id}/amended-inspection', 'InspectionController@amendedInspection');
    
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
