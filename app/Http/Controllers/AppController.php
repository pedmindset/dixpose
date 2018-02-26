<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Company;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.dashboard');
    }

    public function login(){
        return view('auth.login');
    }


    public function logout(){
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/login');
    }

    public function getSubdomain(Company $company){
        $company::where('id', Auth::user()->company_id)->first();
        $url = $company->subdomain.'.'.'766a0bda.com';
        return $url;
    }
}
