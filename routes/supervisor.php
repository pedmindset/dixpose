<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('supervisor')->user();

    //dd($users);

    return view('supervisor.home');
})->name('home');

