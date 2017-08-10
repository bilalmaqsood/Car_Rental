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

Route::get('/vehicle/document/path', function () {
    return response(File::get(resource_path('assets/images/car_img.png')), 200, array('content-type' => 'image/png'));
});

Route::get('/test', function () {
    $schema = \DB::getDoctrineSchemaManager();
    d($schema->listTableColumns((new \Qwikkar\Models\User())->getTable()));
    dd('oknasir');
});
