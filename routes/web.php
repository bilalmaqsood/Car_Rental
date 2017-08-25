<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/terms-and-conditions', 'HomeController@TermsConditions');

Route::get('#reset-password-{token}', 'HomeController@index')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/vehicles', 'HomeController@topVehicles');

Route::get('/vehicle/image/hash', function () {
    return response(File::get(resource_path('assets/images/car_img.png')), 200, array('content-type' => 'image/png'));
});

Route::get('/vehicle/document/path', function () {
    return response(File::get(resource_path('assets/images/car_img.png')), 200, array('content-type' => 'image/png'));
});

Route::get('/test/{id}', function ($id) {
   $booking = \Qwikkar\Models\Booking::whereId($id)->first();
   $owner = $booking->vehicle->owner->user->name;
   $driver = $booking->user->name;

 
   $booking->vehicle->owner->user->notify(new \Qwikkar\Notifications\RatingNotify([
   	"title" => "Rate to ".$driver,
   	"booking_id" => $id,
   	"status" => 12,
   	"old_status" => 12,
   	]));
   $booking->user->notify(new \Qwikkar\Notifications\RatingNotify([
   	"title" => "Rate to ".$owner,
   	"booking_id" => $id,
   	"status" => 12,
   	"old_status" => 12,
   	]));
});
