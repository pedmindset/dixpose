<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Journey;
use App\Models\Customer;
use Illuminate\Http\Request;

class DriverController extends Controller
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
        //show all drivers in the database
        $drivers = Driver::where('company_id', Auth::user()->company_id)
                          ->orderBy('id', 'desc')
                          ->get();
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return the create view page 
       return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store driver's data
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:drivers',
            'password' => 'required|string|min:6|alpha_dash',
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $company = Company::where('id', Auth::user()->company_id)->first();
        $driver = new Driver;
        $driver->company_id = $company->id; 
        $driver->name = $request->name;
        $driver->email = $request['email'];
        $driver->password = bcrypt($request['password']);
        $driver->phone1 = $request->phone1;
        $driver->phone2 = $request->phone2;
        $driver->address = $request->address;
        $driver->save();

        return redirect('drivers/create')->with('status', 'Driver has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get driver and return the update page
        $driver = Driver::where('company_id', Auth::user()->company_id)
                  ->where('id', $id)->first();

        return view('drivers.edit')->with('driver', $driver);
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
        //validate and update driver's data
        $validateData = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6|alpha_dash',
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $driver = Driver::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();

        $driver->name = $request->name;
        $driver->password = bcrypt($request['password']);
        $driver->phone1 = $request->phone1;
        $driver->phone2 = $request->phone2;
        $driver->address = $request->address;
        $driver->save();

        return redirect('drivers')->with('status', 'Driver has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and soft delete driver
        $driver = Driver::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
                        ->first();
        
        $driver->destroy($driver->id);

        return redirect('drivers')->with('status', 'Driver has been successfully Deleted');
    }

    public function schedule()
    {
        $assigned_schedules = $this->assigned_schedules();
        $number_of_assigned_schedules = $this->number_of_assigned_schedules();
        return view('driver/schedule', compact('assigned_schedules', 'number_of_assigned_schedules'));
    }

    public function collection()
    {
        return view('driver/collection');
    }

    public function startSchedule(Request $request, $id)
    {
        //validate and update
        $validateData = $request->validate([
            'status' => 'required|string',
            'startpoint_lg' => 'nullable',
            'startpoint_lt' => 'nullable',
            'startpoint_time' => 'nullable'
        ]);

        $journey = Journey::where('company_id', Auth::user()->company_id)
                            ->where('id', $id)->first();
        $journey->startpoint_lg = $request->startpoint_lg;
        $journey->startpoint_lt = $request->startpoint_lt;
        $journey->startpoint = $request->startpoint_time;
        $journey->status = $request->status;
        $journey->save();

        return redirect('driver/mobile/collections/customer')->with('status', 'Schedule was Started Updated');
    }

    public function assigned_schedules()
    {
        $assigned_schedules = Journey::where('company_id', Auth::user()->company_id)
                            ->where('driver_id', Auth::user()->id)
                            ->where('status', 'created')
                            ->get();
        return $assigned_schedules;
    }

    public function number_of_assigned_schedules()
    {
        $number_of_asigned_schedules = Journey::where('company_id', Auth::user()->company_id)
                            ->where('driver_id', Auth::user()->id)
                            ->where('status', 'created')
                            ->get()->count();
        return $number_of_asigned_schedules;
    }

    public function get_customer_collection($id)
    {
        //return a single collection
        
        $collection = Customer::where('company_id', Auth::user()->company_id)
                        ->with('bin', 'collection')->find($id);
        
        
        
        
        return view('driver/edit', compact('collection'));
    }
}
