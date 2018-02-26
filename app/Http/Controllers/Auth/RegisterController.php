<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Company;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\Subdomain;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    
    protected $redirectTo = 'manager/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'company.required' => 'Please enter the name of your Company'
            
        ];

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|alpha_dash',
            'company' => 'required|string|max:255',
            'subdomain' => 'required|string|max:15|alpha_dash|unique:companies,subdomain',
            'phone' => 'required|integer|min:13'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User;
        $company = new Company;
        $profile = new Profile;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        
        $company->user()->associate($user)->save([
            $company->name = $data['company'],
            $company->subdomain = $data['subdomain'],
            $company->email = $data['email'],
            $company->phone1 = $data['phone']
        ]);

        $profile->user()->associate($user)->save([
            $profile->company_id = $company->id,
            $profile->email = $data['email'],
            $profile->phone1 = $data['phone'],

        ]);

        $newUser = User::find($user->id);
        $newUser->company_id = $company->id;
        $newUser->save();

        return $user;

    }


}
