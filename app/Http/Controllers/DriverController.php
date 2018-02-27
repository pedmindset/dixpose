<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Driver;
use App\Models\Company;

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
        $drivers = Driver::all()->where('company_id', Auth::user()->company_id);
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
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $company = Company::where('id', Auth::user()->company_id)->first();
        $driver = new Driver;
        $driver->company_id = $company->id; 
        $driver->name = $request->name;
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
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $driver = Driver::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();

        $driver->name = $request->name;
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
}
