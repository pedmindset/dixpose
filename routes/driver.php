<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('driver')->user();

    //dd($users);

    return view('driver.home');
})->name('home');

