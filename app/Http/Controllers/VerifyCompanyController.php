<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class VerifyCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function VerifyCompany(Request $request)
    {
        $subdomain = request()->validate([
            'subdomain' => 'required|string|max:20|alpha_dash',
        ]);
        try{
             $company = Company::where('subdomain', $subdomain)->firstOrFail();

        } catch(\Exception $e) {

             return redirect('/')->with('status', 'Company Sub domain Not Found');
        }
        
        $domain = config('app.domain');

        $subdomain_url = $request->subdomain;
       
        $url = "https://$subdomain_url." . $domain . "/login";

        return redirect($url);
          
    }
}
