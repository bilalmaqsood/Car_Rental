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

Route::get('#reset-password-{token}', 'HomeController@index')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/vehicles', 'HomeController@topVehicles');

Route::get('/vehicle/image/hash', function () {
    return response(File::get(resource_path('assets/images/car_img.png')), 200, array('content-type' => 'image/png'));
});

Route::get('test', function () {
    $vehicle = \Qwikkar\Models\Vehicle::find(1);

    $compiledString = \Blade::compileString($vehicle->contractTemplate->template);

    $dataPlaced = render($compiledString, [
        'owner_company' => 'owner_company',
        'owner_name' => 'owner_name',
        'owner_email' => 'owner_email',
        'owner_contact_number' => 'owner_contact_number',
        'driver_name' => 'driver_name',
        'driver_email' => 'driver_email',
        'driver_contact_number' => 'driver_contact_number',
    ]);

    $dataPlaced = str_replace("\n", '<br>', $dataPlaced);

    PDF::loadView('pdf.contract', [
        'owner_signature' => $vehicle->contractTemplate->owner_signature,
        'content' => $dataPlaced
    ])->save(storage_path('app/public/document/' . md5($vehicle->vehicle_name) . '.pdf'));
});
