<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" and "admin" middleware group. Now create something great!
|
*/

Route::get('/', 'AdminController@index')->name('admin');
Route::resource('users', 'UsersController');
Route::resource('bookings', 'BookingController');
Route::resource('promocodes', 'PromoCodeController');
Route::resource('tickets', 'TicketsController');
Route::resource('vehicles', 'VehiclesController');
