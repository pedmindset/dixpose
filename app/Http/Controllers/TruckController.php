<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Company;
use App\Models\Truck;

class TruckController extends Controller
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
        //return all the trucks in the database
        $trucks = Truck::where('company_id', Auth::user()->company_id)
                            ->orderBy('id', 'desc')
                                    ->get();
        return view('trucks.index', compact('trucks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return the form to create the trucks
        return view('trucks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store truck into database
        $validateData = $request->validate([
            'number' => 'required',
            'type' => 'nullable',
            'remarks' => 'nullable'
        ]);

        $company = Company::where('id', Auth::user()->company_id)->first();
        $truck = new Truck;
        $truck->company_id = $company->id;
        $truck->truck_number = $request->number;
        $truck->type = $request->type;
        $truck->remarks - $request->remarks;
        $truck->save();

        return redirect('trucks/create')->with('status','Truck was created successfully');
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
        //return edit page
        $truck = Truck::where('company_id', Auth::user()->company_id)
                ->where('id', $id)->first();
        return view('trucks.edit')->with('truck', $truck);
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
            'number' => 'required',
            'type' => 'nullable',
            'remarks' => 'nullable'
        ]);

        $truck = Truck::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        $truck->truck_number = $request->number;
        $truck->type = $request->type;
        $truck->remarks - $request->remarks;
        $truck->save();

        return redirect('trucks')->with('status','Truck was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find and soft delete
        $truck = Truck::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
                        ->first();

        $truck->destroy($truck->id);
        return redirect('trucks')->with('status', 'Truck has been successfully deleted');
    }
}
