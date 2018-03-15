<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Supervisor;
use App\Models\Company;

class SupervisorController extends Controller
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
        //show all Supervisors in the database
        $supervisors = Supervisor::where('company_id', Auth::user()->company_id)
                                    ->orderBy('id', 'desc')
                                    ->get();
        return view('supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return the create view page 
       return view('supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store Supervisor's data
        $validateData = $request->validate([
            'name' => 'required|string',
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $company = Company::where('id', Auth::user()->company_id)->first();
        $supervisor = new Supervisor;
        $supervisor->company_id = $company->id; 
        $supervisor->name = $request->name;
        $supervisor->phone1 = $request->phone1;
        $supervisor->phone2 = $request->phone2;
        $supervisor->address = $request->address;
        $supervisor->save();

        return redirect('supervisors/create')->with('status', 'Supervisor has been successfully created');
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
        //get Supervisor and return the update page
        $supervisor = Supervisor::where('company_id', Auth::user()->company_id)
                  ->where('id', $id)->first();

        return view('supervisors.edit')->with('supervisor', $supervisor);
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
        //validate and update Supervisor's data
        $validateData = $request->validate([
            'name' => 'required|string',
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'address' => 'nullable'
        ]);

        $supervisor = Supervisor::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();

        $supervisor->name = $request->name;
        $supervisor->phone1 = $request->phone1;
        $supervisor->phone2 = $request->phone2;
        $supervisor->address = $request->address;
        $supervisor->save();

        return redirect('supervisors')->with('status', 'Supervisor has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and soft delete Supervisor
        $supervisor = Supervisor::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        
        $supervisor->destory($supervisor->id);

        return redirect('Supervisors')->with('status', 'Supervisor has been successfully Deleted');
    }
}
