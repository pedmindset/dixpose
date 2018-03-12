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

/**
**/

Route::get('/dashboard', 'SuperAdmin\AdminController@dashboard');

Route::group(['prefix' => 'customer'], function () {
  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'CustomerAuth\LoginController@login');
  Route::post('/logout', 'CustomerAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'CustomerAuth\RegisterController@register');

  Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'driver'], function () {
    Route::get('/login', 'DriverAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'DriverAuth\LoginController@login');
    Route::post('/logout', 'DriverAuth\LoginController@logout')->name('logout');
  
    Route::post('/password/email', 'DriverAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'DriverAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'DriverAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'DriverAuth\ResetPasswordController@showResetForm');
  });
  
  Route::group(['prefix' => 'supervisor'], function () {
    Route::get('/login', 'SupervisorAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'SupervisorAuth\LoginController@login');
    Route::post('/logout', 'SupervisorAuth\LoginController@logout')->name('logout');
  
    Route::post('/password/email', 'SupervisorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'SupervisorAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'SupervisorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'SupervisorAuth\ResetPasswordController@showResetForm');
  });
  


Route::get('/', 'AppController@subdomain');

Route::post('/verify/signin', 'VerifyCompanyController@verifyCompany')->name('signin');

Route::get('/logout', 'AppController@logout')->name('logout');

Route::auth();


  Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'manager'], function () {

          Route::get('dashboard', 'Manager\DashboardController@index')->name('dashboard');
          Route::get('schedules/report', 'Manager\DashboardController@get_schedule_report');
          Route::get('collections/report', 'Manager\DashboardController@get_collection_report');
          Route::get('bins/report', 'Manager\DashboardController@get_bin_report');
        
    });
 
     Route::resource('zones', 'ZoneController');
     Route::resource('servicezones', 'ServiceZoneController');
     Route::resource('bins', 'BinController');
     Route::resource('classifications', 'ClassificationController');
     Route::resource('drivers', 'DriverController');
     Route::resource('trucks', 'TruckController');
     Route::resource('supervisors', 'SupervisorController');
     Route::resource('schedules', 'JourneyController');
     Route::resource('collections', 'CollectionController');
     Route::resource('customers', 'CustomerController');
     Route::get('customers/sort/{key}', 'CustomerController@customerSort');
     Route::get('customers/search/{value}', 'CustomerController@searchCustomer');
     Route::get('/logout', 'AppController@logout')->name('logout');
});
//  Route::group(['prefix' => 'api/v1'], function () {
//     Route::apiResource('collections', 'API/CollectionController');
//  });
/**Route::domain('{subdomain}.dixpose.dev')->group(function () {
    Route::middleware('auth')->group(function(){
       // Route::get('subdomain', 'AppController@redirectToDashbaord');

        Route::get('manager/dashboard', 'AppController@index')->name('dashboard');
        Route::resource('zones', 'ZoneController');
        Route::resource('servicezones', 'ServiceZoneController');
        Route::resource('bins', 'BinController');
        Route::resource('classifications', 'ClassificationController');
        Route::resource('drivers', 'DriverController');
        Route::resource('trucks', 'TruckController');
        Route::resource('supervisors', 'SupervisorController');
        Route::resource('schedules', 'JourneyController');
        Route::resource('collections', 'CollectionController');
        Route::resource('customers', 'CustomerController');
        Route::get('customers/sort/{key}', 'CustomerController@customerSort');
        Route::get('customers/search/{value}', 'CustomerController@searchCustomer');
        Route::get('/logout', 'AppController@logout')->name('logout');
    });
         
});**/



