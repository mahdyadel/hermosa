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

Route::get('/', function () { return view('welcome'); });
Route::get('/home', function () { return view('/home'); });
Route::get('/payment', function () { return view('payment'); });

Route::post('/locale', function(){
    session()->put('locale', request()->locale);
    return redirect()->back();
});

Route::group(['namespace' => 'Admin'], function()
{
    Auth::routes();
    Route::resource('/promocodes', 'PromocodeController');
    Route::patch('/promocodes/{promocode}/status', 'PromocodeController@status');
    Route::resource('/packages', 'PackageController');
    Route::patch('/packages/{package}/status', 'PackageController@status');
    Route::patch('/users/{user}/block', 'UserController@block');
    Route::resource('/users', 'UserController');
    Route::resource('/admins', 'AdminController');
    Route::get('/services/json', 'ServiceController@json');
    Route::resource('/services', 'ServiceController');
    Route::patch('/services/{service}/status', 'ServiceController@status');
    Route::get('/salons/export', 'SalonController@export');
    Route::resource('/salons', 'SalonController');
    Route::get('/salons/{salon}/bills', 'SalonController@bills');
    Route::patch('/salons/{salon}/status', 'SalonController@status');
    Route::resource('/salons/{salon}/services', 'SalonServiceController');
    Route::patch('/salons/{salons}/services/{service}/status', 'SalonServiceController@status');

    Route::resource('/salons/{salon}/offers', 'SalonServiceOfferController');
    Route::patch('/salons/{salons}/offers/{offer}/status', 'SalonServiceOfferController@status');

    Route::get('/salons/{salon}/employees/{employee}/rates', 'EmployeeRateController@index');
    Route::delete('/salons/{salon}/employees/{employee}/rates/{rate}', 'EmployeeRateController@destroy');

    Route::resource('/salons/{salon}/employees', 'EmployeeController');
    Route::patch('/salons/{salons}/employees/{employee}/status', 'EmployeeController@status');
    Route::get('/salons/{salon}/reservations/export', 'ReservationController@export');
    Route::resource('/salons/{salon}/reservations', 'ReservationController');
    Route::get('/salons/{salon}/reservations/{reservation}/bill', 'ReservationController@bill');

    Route::resource('/salons/{salon}/working-days', 'SalonWorkingDayController');
    Route::get('/salons/{salon}/rates', 'SalonRateController@index');
    Route::delete('/salons/{salon}/rates/{rate}', 'SalonRateController@destroy');
    Route::resource('/countries', 'CountryController');
    Route::patch('/countries/{country}/status', 'CountryController@status');
    Route::get('/countries/{country}/cities/json', 'CityController@json');
    Route::resource('/countries/{country}/cities', 'CityController');
    Route::patch('/countries/{country}/cities/{city}/status', 'CityController@status');


});