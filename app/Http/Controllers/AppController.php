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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.dashboard');
    }

    public function subdomain()
    {
        $url = "https://app.dixpose.dev/login";
        return  redirect($url);
    }


    public function logout(){
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/login');
    }

    public function getSubdomain(Company $company){
        $company::where('id', Auth::user()->company_id)->first();
        $url = "$company->subdomain";
        return $url;
    }
}
