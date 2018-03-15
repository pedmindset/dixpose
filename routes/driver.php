<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('driver')->user();

    //dd($users);

    return redirect('/driver/mobile/collections');
})->name('home');

Route::get('/mobile/collections/', 'DriverController@schedule');
Route::get('/mobile/collections/customer', 'DriverController@collection');
Route::put('/mobile/schedule/{id}', 'DriverController@startSchedule')->name('updateSchedule');
Route::get('/logout/', 'DriverController@logout');

