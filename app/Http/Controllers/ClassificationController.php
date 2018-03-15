<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\Bin;
use App\Models\Company;
use Auth;

class ClassificationController extends Controller
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
        //show all classifications in database
        $classifications = Classification::where('company_id', Auth::user()->company_id)
                                          ->orderBy('id', 'desc')
                                          ->get();

        return view('classifications.index')->with('classifications', $classifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return the page to create a classification
        return view('classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store classification
        $validateData = $request->validate([
            'classification' => 'required|string',
            'description' => 'nullable'
        ]);
        
        $company = Company::where('id', Auth::user()->company_id)->first();
        $classification = new Classification;
        $classification->company_id = $company->id;
        $classification->class  = $request->classification;
        $classification->description = $request->description;
        $classification->save();

        return redirect('classifications/create')->with('status', 'Classifications has been added successfully');
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
        //return the page to update a classification

        $classification = Classification::where('company_id', Auth::user()->company_id)
                                         ->where('id', $id)
                                         ->first();

        return view('classifications.edit', compact('classification'));
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
        //validate and update classification
        $validateData = $request->validate([
            'classification' => 'required|string',
            'description' => 'nullable'
        ]);

        
        $classification = Classification::where('company_id', Auth::user()->company_id)
                                         ->where('id', $id)
                                         ->first();
        $classification->class = $request->classification;
        $classification->description = $request->description;
        $classification->save();
       
        return redirect('classifications')->with('status', 'Classifications has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete classification
        $classification = Classification::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        $classification->destroy($classification->id);

        return redirect('classifications')->with('status', 'Classifications has been deleted successfully');
 
    }
}
