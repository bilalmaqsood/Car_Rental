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
Route::post('users/{id}/verify', 'UsersController@verifyDriver')->middleware('admin')->name("users.verify");
Route::resource('users', 'UsersController');
Route::resource('bookings', 'BookingController');
Route::resource('promocodes', 'PromocodeController');
Route::resource('tickets', 'TicketsController');
Route::post('vehicles/{id}/verify', 'VehiclesController@verifyVehicle')->middleware('admin')->name("vehicles.verify");
Route::resource('vehicles', 'VehiclesController');
