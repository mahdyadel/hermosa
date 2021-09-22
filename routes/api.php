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

Route::group(['prefix' => 'v1', 'namespace' => 'API', 'middleware' => 'forceUpdate'], function () 
{  
    // AUTH
    Route::group(['prefix' => 'auth'], function() {
        // LOGIN & SIGNUP
        Route::post('/login','AuthController@login');
        Route::post('/signup','AuthController@signup');
        // REFRESH TOKENS
        Route::post('/token/refresh','AuthController@refreshJWTToken');
        Route::post('/fcm/refresh','AuthController@refreshFCMToken');
        
        // RESET PASSWORD
        Route::post('/reset/password','ForgetPasswordController@sendResetCode');
        Route::post('/reset/password/resend','ForgetPasswordController@resendResetCode');
        Route::post('/reset/password/confirm','ForgetPasswordController@confirmResetCode');
        Route::post('/reset/password/update','ForgetPasswordController@updatePassword');
    });

    // PRTOTECTED ROUTES
    Route::group(['middleware' => 'jwt'], function()
    {
        // AUTH
        Route::post('/auth/logout','AuthController@logout');

        // Route::post('/reservation','ReservationController@reservation');
        Route::get('/home','HomeController@index');

        Route::get('/salons/{salon}/services/{service}/employess','EmployeeController@index');

        Route::get('/payment-types','PaymentTypeController@index');

    });

    Route::post('/checkout','ReservationController@checkout');
    Route::post('/reservation','ReservationController@reservation');

    Route::get('/countries','CountryController@index');
    Route::get('/countries/{country}/cities','CityController@index');


});