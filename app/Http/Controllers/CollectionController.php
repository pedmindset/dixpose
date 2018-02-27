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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all collections
        $collections = Collection::where('company_id', Auth::user()->company_id)->paginate(20);

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
        $bins = Bins::all()
                ->where('company_id', Auth::user()->company_id);

        return view('collections.create', compact('customers', 'bins'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
