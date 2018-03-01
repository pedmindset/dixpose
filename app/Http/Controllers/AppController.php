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
        $this->middleware('auth')->except('subdomain');
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

    /**public function subdomain()
    {
        $domain = config('app.domain', 'dixpose.dev');
       
        $url = "https://app." . $domain . "/login";

        return  redirect($url);
    }**/

    /**public function redirectToDashbaord()
    {
        $company = Company::where('id', Auth::user()->company_id)->first();

        $subdomain = $company->subdomain;

        $domain = config('app.domain', 'dixpose.dev');
       
        $url = "https://$subdomain." . $domain . "/manager/dashboard";

        return redirect($url);
    }**/


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
