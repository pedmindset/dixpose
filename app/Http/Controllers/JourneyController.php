<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journey;
use App\Models\Company;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Supervisor;
use App\Models\ServiceZone;
use Auth;

class JourneyController extends Controller
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
        //show all schedule in database
        $schedules = Journey::where('company_id', Auth::user()->company_id)
                            ->orderBy('id', 'desc')
                                    ->get();

        return view('schedules.index')->with('schedules', $schedules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return the create view for Journey
        $service_zones = ServiceZone::all()->where('company_id', Auth::user()->company_id);
        $trucks = Truck::all()->where('company_id', Auth::user()->company_id);
        $drivers = Driver::all()->where('company_id', Auth::user()->company_id);
        $supervisors = Supervisor::all()->where('company_id', Auth::user()->company_id);

        return view('schedules.create', 
                    compact(
                        'service_zones', 'trucks', 'drivers', 'supervisors'
                    )
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store journey
        $validateData = $request->validate([
            'supervisor' => 'required|integer',
            'sector' => 'required|integer',
            'driver' => 'required|integer',
            'truck' => 'required|integer',
            'pick_up_date' => 'required',
            'status' => 'required|string',
            'remarks' => 'nullable'
        ]);

        $company = Company::where('id', Auth::user()->company_id)->first();
        $journey = new Journey;
        $journey->company_id = $company->id;
        $journey->service_zone_id = $request->sector;
        $journey->supervisor_id = $request->supervisor;
        $journey->driver_id = $request->driver;
        $journey->truck_id = $request->truck;
        $journey->pickupdate = $request->pick_up_date;
        $journey->status = $request->status;
        $journey->remarks = $request->remarks;
        $journey->save();

        return redirect('schedules/create')->with('status', 'Schedule was successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single journey
        $journey = Journey::where('company_id', Auth::user()->company_id)
                            ->where('id', $id)
                            ->first();
        return view('schedules.show')->with('journey', $journey);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return schedule update page
         // return the create view for Journey
         $service_zones = ServiceZone::all()->where('company_id', Auth::user()->company_id);
         $trucks = Truck::all()->where('company_id', Auth::user()->company_id);
         $drivers = Driver::all()->where('company_id', Auth::user()->company_id);
         $supervisors = Supervisor::all()->where('company_id', Auth::user()->company_id);
         $schedule = Journey::where('company_id', Auth::user()->company_id)
                             ->where('id', $id)->first();
 
         return view('schedules.edit', 
                     compact(
                         'service_zones', 'trucks', 'drivers', 'supervisors', 'supervisor', 'schedule'
                     )
                 );
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
        //validate and update
        $validateData = $request->validate([
            'supervisor' => 'required|integer',
            'sector' => 'required|integer',
            'driver' => 'required|integer',
            'truck' => 'required|integer',
            'pick_up_date' => 'required',
            'status' => 'required|string',
            'remarks' => 'nullable'
        ]);

        $journey = Journey::where('company_id', Auth::user()->company_id)
                            ->where('id', $id)->first();
        $journey->service_zone_id = $request->sector;
        $journey->supervisor_id = $request->supervisor;
        $journey->driver_id = $request->driver;
        $journey->truck_id = $request->truck;
        $journey->pickupdate = $request->pick_up_date;
        $journey->status = $request->status;
        $journey->remarks = $request->remarks;
        $journey->save();

        return redirect('schedules')->with('status', 'Schedule was successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete journey
        $journey = Journey::where('company_id', Auth::user()->company_id)
                            ->where('id', $id)->first();
        $journey->destroy($journey->id);

        return redirect('schedules')->with('status', 'Schedule has been succeesully been deleted');
    }
}
