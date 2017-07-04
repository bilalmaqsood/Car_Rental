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

Route::get('/test', function () {
//    $vehicle = Qwikkar\Models\Vehicle::find(1);
    $user = Qwikkar\Models\User::find(2);

    $faq = Qwikkar\Models\Faq::findOrFail(1);

    $faq->answer = 'lorem ipsam dlor sans emit oknasir.';
    $faq->user()->associate($user);

    $faq->save();
    dd($faq);

//    $booking = Qwikkar\Models\Booking::find(1);

//    $balanceLog = \Qwikkar\Models\BalanceLog::firstOrNew(['amount' => 999.99, 'comment' => 'lorem ipsam sans emit']);

//    $balanceLog->balance()->associate($user->balance);
//    $booking->balanceLogs()->save($balanceLog);

//    d($user->balance->logs->first()->loggable);
//    d($user->balance->logs);
//    d($booking->balanceLogs);

//    $promoCode = Qwikkar\Models\PromoCode::find(4);
//    $booking = Qwikkar\Models\Booking::find(10);
//    $user = Qwikkar\Models\User::find(1);
//    d($user->promoCodes()->save($promoCode));
//    d($booking->promoCodes()->save($promoCode));

//    $user = Qwikkar\Models\User::find(1);
//    $booking = Qwikkar\Models\Booking::find(10);
//    d($user->promoCodes);
//    d($booking->promoCodes);

//    d(\Qwikkar\Models\PromoCode::generate(8, 11.45, \Carbon\Carbon::now()->addYear()));

    d(\Qwikkar\Concerns\Coupon::generate());
    d(\Illuminate\Support\Facades\Password::getRepository()->createNewToken());
    \DB::enableQueryLog();
    d(\DB::getQueryLog());
    d(storage_path('fonts'));
    dd(File::allFiles(storage_path('fonts')));
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/search', 'HomeController@search')->name('search');