<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Zone;
use App\Models\ServiceZone;
use App\Models\Bin;
use App\Models\Classification;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all customers in the database
        $customers = Customer::all()->where('company_id', Auth::user()->company_id);
       
        return view('customers.index')->with('customers', $customers);

    }
    /**
     * Display a listing of the customers based on zones,sectors and classification.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerSort($key)
    {

        $adjusted_key = str_finish($key, '_id');

        $customers = Customer::all()
                    ->where('company_id', Auth::user()->company_id);

        $sorted = $customers->sortBy($adjusted_key);

        $sortedData = $sorted->values()->all();

        return $sortedData;
    }
    /**
     * Show a single customers based from the database
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCustomer($value)
    {
        $customer = Customer::where('company_id', Auth::user()->company_id)
                    ->where('name', 'LIKE', "%$value%")->get();

        return $customer;
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create customer page
        $zones = Zone::all()->where('company_id', Auth::user()->company_id);

        $service_zones = ServiceZone::all()->where('company_id', Auth::user()->company_id);

        $classifications = Classification::all()->where('company_id', Auth::user()->company_id);

        $bins = Bin::all()->where('company_id', Auth::user()->company_id);

        return view('customers.create', compact('zones', 'service_zones', 'classifications', 'bins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store customer data
        $messages = [
            'phone1.integer' => 'Please :Phone 1 enter a correct phone number',
            'phone2.integer' => 'Please :Phone 2 enter a correct phone number'            
        ];

        $validateData = $request->validate([
            'name' => 'required|string',
            'zone' => 'required|integer',
            'service_zone' => 'required|integer',
            'classification' => 'required|integer',
            'email' => 'nullable|email',
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable',
            'ghana_gps' => 'nullable|max:10',
            'frequency' => 'required|string',
            'bins'  =>  'nullable'
        ]);

        $customer = new Customer;

        $zone = Zone::where('company_id', Auth::user()->company_id)
                ->where('id', $request->zone)->first();

        $serviceZone = ServiceZone::where('company_id', Auth::user()->company_id)
                ->where('id', $request->service_zone)->first();

        $company = Company::where('id', Auth::user()->company_id)->first();

        $customer->company_id = $company->id;
        $customer->zone_id = $zone->id;
        $customer->service_zone_id = $serviceZone->id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone1 = $request->phone1;
        $customer->phone2 = $request->phone2;
        $customer->address = $request->address;
        $customer->classification_id = $request->classification;
        $customer->ghana_gps = $request->ghana_gps;
        $customer->frequency = $request->frequency;
        $customer->save();

        $customer->bin()->attach($request->bins);

        return redirect('customers/create')->with('status', "Customer has been successfully added");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single customer
        $customer = Customer::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)->first();
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show the edit page for customer
        $customer = Customer::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)->first();

         $zones = Zone::all()->where('company_id', Auth::user()->company_id);

        $service_zones = ServiceZone::all()->where('company_id', Auth::user()->company_id);

        $classifications = Classification::all()->where('company_id', Auth::user()->company_id);

        return view('customers.edit', compact('customer', 'zones', 'service_zones', 'classifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate and save customer data
        $validateData = $request->validate([
            'name' => 'required|string',
            'zone' => 'required|integer',
            'service_zone' => 'required|integer',
            'email' => 'nullable|email',
            'phone1' => 'nullable|integer',
            'phone2' => 'nullable|integer',
            'address' => 'nullable|integer',
            'classification' => 'required|integer',
            'ghana_gps' => 'nullable',
            'frequency' => 'required|string',
            'bins' => 'nullable'
        ]);

        $zone = Zone::where('company_id', Auth::user()->company_id)
                ->where('id', $request->zone)->first();

        $serviceZone = ServiceZone::where('company_id', Auth::user()->company_id)
                ->where('id', $request->service_zone)->first();

        $customer = Customer::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)->first();
        $customer->zone_id = $zone->id;
        $customer->service_zone_id = $serviceZone->id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone1 = $request->phone1;
        $customer->phone2 = $request->phone2;
        $customer->address = $request->address;
        $customer->classification_id = $request->classification;
        $customer->ghana_gps = $request->ghana_gps;
        $customer->frequency = $request->frequency;
        $customer->save();

        $customer->bin()->attach([$request->bins]);

        return redirect('customers')->with('status', 'Customer has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete customer
        $customer = Customer::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        $customer->destroy($customer->id);

        return redirect('customers')->with('status', 'Customer successfully deleted');
    }
}
