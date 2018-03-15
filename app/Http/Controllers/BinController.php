<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Bin;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Classification;


class BinController extends Controller
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
        //show all bins in the database
        $bins = Bin::where('company_id', Auth::user()->company_id)
                ->orderBy('id', 'desc')
                ->get();
        return view('bins.index')->with('bins', $bins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return a view to store bins
        $classifications = Classification::where('company_id', Auth::user()->company_id)
                                          ->get(['id', 'class']);
        return view('bins.create', compact('classifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store
        $validateData = $request->validate([
            'type' => 'required',
            'desc' => 'nullable',
            'classification' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $bin = new Bin;
        $company = Company::where('id', Auth::user()->company_id)->first();
        $bin->company_id = $company->id;
        $bin->type = $request->type;
        $bin->desc = $request->desc;
        $bin->price = $request->price;
        $bin->classification_id = $request->classification;
        $bin->save();

        return redirect('bins/create')->with('status', 'Bin has been successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single bin
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bin = Bin::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)->first();
        $classifications = Classification::where('company_id', Auth::user()->company_id)
                                         ->get(['id', 'class']);
       //return the edit page
       return view('bins.edit', compact('bin', 'classifications'));
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
        
        //validate and edit bin
         $validateData = $request->validate([
            'type' => 'required',
            'desc' => 'nullable',
            'classification' => 'required|integer',
            'price' => 'required|integer'
        ]);

        $bin = Bin::where('company_id', Auth::user()->company_id)
               ->where('id', $id)->first();
        $bin->type = $request->type;
        $bin->desc = $request->desc;
        $bin->price = $request->price;
        $bin->classification_id = $request->classification;
        $bin->save();

        return redirect('bins')->with('status', 'Bin was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //soft delete bin
        $bin = Bin::where('company_id', Auth::user()->company_id)
        ->where('id', $id)->first();
        $bin->destroy($bin->id);

        return redirect('bins')->with('status', 'Bin has been successfully deleted');
    }
}
