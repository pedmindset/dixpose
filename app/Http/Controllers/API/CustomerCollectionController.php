<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Zone;
use App\Models\ServiceZone;
use App\Models\Bin;
use App\Models\Classification;
use App\Models\Collection;
use App\Http\Resources\CustomerCollectionResource;
use App\Http\Resources\CollectionsResource;




class CustomerCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all collections in database

        $collections = Customer::with('company', 'bin', 'collection', 'classification', 'zone', 'service_zone')->paginate(20);

        if (! $collections) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        $resource = CustomerCollectionResource::collection($collections);
        return $resource->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return a single collection
        $collection = Customer::with('company', 'bin', 'collection', 'classification', 'zone', 'service_zone')->find($id);

        if (! $collection) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        
        $resource = new CustomerCollectionResource($collection);
        return $resource->response()->setStatusCode(200);
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
        $collection = $request->validate([
            'collection' => 'required',
            'bins' => 'required',
            'ghanaGPS' => 'nullable',
            'address' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'radius' => 'nullable',
            'frequency' => 'nullable',
            'updated' => 'required'
        ]);

        // asume it won't work

            $success = false;

            DB::beginTransaction();

            try {                
                    $collections = Collection::where('id', $request->collection)->first();
                    $collections = $collection->status;
                    $collections = $collection->updated;
                    if ($collections->save()) {
                        $collections->bin()->attach([$request->bins]);
                        $success = true;
                    }
                
            } catch (\Exception $e) {
               // maybe log this exception, but basically it's just here so we can rollback if we get a surprise

            }

            if ($success) {
                DB::commit();
                return  response()->json([
                    'Collection was successfully updated to completed', 200
                    ]);
            } else {
                DB::rollback();
                return response()->json([
                    'Something went wrong', 404
                    ]);
            }
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
