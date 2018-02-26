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
use App\Models\Company;



Route::get('/', function()
    {
        if(Auth::user()){
           return redirect('manager/dashboard');
        }else{
            return redirect('login');
        }
    }
);

/**if(Auth::user())
{
    $company = Company::where('id', Auth::user()->company_id)
               ->first();
    $subdomain = $company->subdomain;

    return $subdomain;
}
**/


Route::auth();

/**Route::get('manager/dashboard', 'AppController@index')->name('dashboard');

Route::domain('{$subdomain}.dixpose.com')->group(function () {

    Route::middleware('auth')->group(function(){
      
       
        Route::resource('zones', 'ZoneController');
        Route::resource('servicezones', 'ServiceZoneController');
        Route::resource('bins', 'BinController');
        Route::resource('customers', 'CustomerController');
        Route::resource('classifications', 'ClassificationController');
        Route::resource('drivers', 'DriverController');
        Route::resource('trucks', 'TruckController');
        Route::resource('supervisors', 'SupervisorController');
        Route::resource('schedules', 'JourneyController');
        Route::get('/logout', 'AppController@logout')->name('logout');
    });
    
        
});
**/
Route::middleware('auth')->group(function(){
      
    Route::get('manager/dashboard', 'AppController@index')->name('dashboard');
    Route::resource('zones', 'ZoneController');
    Route::resource('servicezones', 'ServiceZoneController');
    Route::resource('bins', 'BinController');
    Route::resource('classifications', 'ClassificationController');
    Route::resource('drivers', 'DriverController');
    Route::resource('trucks', 'TruckController');
    Route::resource('supervisors', 'SupervisorController');
    Route::resource('schedules', 'JourneyController');

    Route::resource('customers', 'CustomerController');
    Route::get('customers/sort/{key}', 'CustomerController@customerSort');
    Route::get('customers/search/{value}', 'CustomerController@searchCustomer');
    Route::get('/logout', 'AppController@logout')->name('logout');
});




