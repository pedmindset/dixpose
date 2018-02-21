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

Route::Auth();

Route::middleware('auth')->group(function(){
      
    Route::get('/dashboard', 'AppController@index')->name('dashboard')->middleware('auth');
    Route::resource('zones', 'ZoneController')->middleware('auth');
    Route::resource('servicezones', 'ServiceZoneController')->middleware('auth');
    Route::resource('bins', 'BinController')->middleware('auth');
    Route::resource('customers', 'CustomerController')->middleware('auth');
});

Auth::routes();

Route::get('users/{id}', function ($id) {
    $zone = App\Models\Zone::where('company_id', Auth::user()->company_id)
    ->where('id', $id)->first();
    
});


Route::get('/logout', 'AppController@logout')->name('logout');


