<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Bin;
use Auth;

class CollectionController extends Controller
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
        //return all collections
        $collections = Customer::where('company_id', Auth::user()->company_id)
        ->orderBy('id', 'desc')
        ->with('collection', 'company', 'bin')
        ->get();

        return $collections;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show a create page to create collection 
        $customers = Customer::all()
                    ->where('company_id', Auth::user()->company_id);

        return view('collections.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate and store collection
        $validateData = $request->validate([
            'customer' => 'required|integer',
            'status' => 'required|string',
        ]);

        $company = Company::where('company_id', Auth::user()->company_id)
                   ->first();
        $collection = new Collection;
        $collection->customer_id = $request->customer;
        $collection->company_id = $company->id;
        $collection->status =$request->status;
        $collection-save();
                 
        return view('collection.create')->with('status', 'Collection has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single collection
        $collection = Collection::where('company_id', Auth::user()->company_id)
                      ->where('id', $id)
                      ->first();
        return view('collections.show')->with('collection', $collection);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show the edit page to update collection 
        $customers = Customer::where('company_id', Auth::user()->company_id)
                    ->where('id', $id)
                    ->first();

        return view('collections.create', compact('customers'));
    }

    public function schedule()
    {
        return view('collections/API/schedule');
    }

    public function collection()
    {
        return view('collections/API/collection');
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
        //validate and update collection
        $validateData = $request->validate([
            'status' => 'required|string',
            'pick_up_date' => 'required',
            'bins' => 'required'
        ]);

        $collection = Collection::where('company_id', Auth::user()->company_id)
                      ->where('id', $id)
                      ->first();

        $collection->status = $request->status;
        $collection->pick_up_date = $request->pick_up_date;
        $collection->save();

        $collection->bin()->attach($request->bins);

        return redirect('collections/create')->with('status', 'Collections has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a collection
        $collection = Collection::where('company_id', Auth::user()->company_id)
                      ->where('id', $id)
                      ->first();
        $collection->destroy($collection->id);

        return redirect('collections')->with('status', 'Collection has been succefully deleted');
    }
}
