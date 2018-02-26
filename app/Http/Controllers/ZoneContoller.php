<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Company;
use Auth;
use App\User;

class ZoneController extends Controller
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
        //Show all Zones in Database
        $zones = Zone::all()->where('company_id', Auth::user()->company_id);
        return view('zones.index')->with('zones', $zones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zones.create');
    }

    /**
     * Store a new Zone data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store zones
        $validateData = $request->validate([
            'name' => 'required|unique:zones,name',
            'description' => 'nullable',
        ]);

        //store zones
        $company = Company::where('user_id', Auth::id())->first();
        $zones = new Zone;
        $zones->company_id = $company->id;
        $zones->name = $request->name;
        $zones->desc = $request->description;
        $zones->save();

        return redirect('zones/create')->with('status','Zone was created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a specific zone information
        $zone = Zone::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        
        return view('zones.show')->with('zone', $zone);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show the form to edit
        $zone = Zone::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();

        return view('zones.edit')->with('zone', $zone);
        
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
        //validate and update zones
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        //edit a zone info
        $zone = Zone::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        $zone->name = $request->name;
        $zone->desc = $request->description;
        $zone->save();
        $url = 'zones/'.$id;

        

        return redirect($url)->with('status', 'Zone was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //softdelete zone
        $zone = Zone::where('company_id', Auth::user()->company_id)
                     ->where('id', $id)->first();

        $zone->destroy($zone->id);
        return redirect('zones')->with('status', 'Zone has been successfully deleted');
        
    }

}
