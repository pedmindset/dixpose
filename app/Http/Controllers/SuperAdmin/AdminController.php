<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }
}
