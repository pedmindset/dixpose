<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceZone;
use App\Models\Company;
use App\Models\Zone;
use Auth;

class ServiceZoneController extends Controller
{
     /**
     * Restrict access.
     *
     * @return \Illuminate\Http\Response
     */

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
        //show all service zones
        $service_zones = ServiceZone::all();
        $company_service_zone = $service_zones->where('company_id', Auth::user()->company_id);
        return view('servicezones.index')->with('service_zones', $company_service_zone);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zone::all();
        $company_zones = $zones->where('company_id', Auth::user()->company_id);
        //return a the create view page
        return view('servicezones.create')->with('zones', $company_zones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $validateData = $request->validate([
            'zone' => 'required|integer',
            'name' => 'required|unique:service_zones,name',
            'desc' => 'nullable'
        ]);

        //store service zones
        $service_zone = new ServiceZone;
        $company = Company::where('id', Auth::user()->company_id)->first();
        $service_zone->company_id = $company->id;
        $service_zone->zone_id = $request->zone;
        $service_zone->name = $request->name;
        $service_zone->desc = $request->desc;
        $service_zone->save();

        return redirect('servicezones/create')->with('status', 'Service Zone was succefully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single service zone
        $service_zone = ServiceZone::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)->first();
        return view('servicezones.show')->with('service_zone', $service_zone);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return the upadte view for service zone
        $service_zone = ServiceZone::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)->first();
        return view('servicezones.edit')->with('service_zone', $service_zone);
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
        //validate data
        $validateData = $request->validate([
            'zone' => 'required|integer',
            'name' => 'required',
            'desc' => 'nullable'
        ]);

        $service_zone = ServiceZone::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)->first();
        $service_zone->zone_id = $request->zone;
        $service_zone->name = $request->name;
        $service_zone->desc = $request->desc;
        $service_zone->save();
        $url = 'servicezones/'.$id;

        return redirect($url)->with('status', 'Service Zone was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete service zone
        $service_zone = ServiceZone::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)->first();
        $service_zone->destroy($service_zone->id);

        return redirect('servicezones')->with('status', 'Zone has been successfully deleted');
    }

}
