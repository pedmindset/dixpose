<?php

namespace App\Http\Controllers\API;

use Auth;
use Notification;
use App\Models\Bin;
use App\Models\Zone;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Collection;
use App\Models\ServiceZone;
use Illuminate\Http\Request;
use Sms;
use App\Models\Classification;
use Illuminate\Support\Facades\DB;
use App\Notifications\BinCollected;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionsResource;
use App\Http\Resources\CustomerCollectionResource;





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

        $collections = Customer::where('company_id', Auth::user()->company_id)
                     ->with('bin', 'collection')->paginate(20);

        if (! $collections) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
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
        
        $collection = Customer::where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
                        ->with(['collection' => function ($query) {
                                        $query->where('status', 'Pending');
                        }, 'bin'])
                        ->first();

                
        
        if (! $collection) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404)->withHeaders([
                'Content-Type' => 'application/json',
            ]);
        }
        
       
        return $collection;
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
            'bins' => 'required', //array
            'status' => 'required',
            'ghanaGPS' => 'nullable',
            'address' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'radius' => 'nullable',
            'customer' => 'nullable',
            'collection' => 'nullable'
        ]);
        

        // asume it won't work

            $success = false;

            DB::beginTransaction();

            try {                
                    $collection = Collection::where('company_id', Auth::user()->company_id)

                                  ->where('id', $id)

                                  ->where('customer_id', $request->customer)
                                  
                                  ->first();
                                  

                    $collection->status = $request->input('status');
                    
                    if ($collection->save()) {

                        $customerName = $collection->customer->name;
                        $customerPhone = $collection->customer->phone1;
                        $bins = $request->input('bins');

                        $decodeBins = json_decode($bins, true);

                        $myBin = [];
                        $arrayBinLenght = sizeof($bins);
                       
                        foreach ($decodeBins as $bin => $value) {
                            $myBin += $value;
                        }

                        $binsValue = implode(",", $myBin);
                        
                        $collection->bin()->attach($myBin);
                    
                        $message  = "Hello $customerName, Your were collected Today.   Thank You";
                        $to       = $customerPhone;
                        $from     = env('TWILIO_FROM');
                        $response = Sms::send($message,$to,$from);
                    
                        $success = true;
                    }
                
            } catch (\Exception $e) {
                
               // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
               return  response()->json([
                'Couldnt find collection',$e->getMessage(), 422
                ])->withHeaders([
                    'Content-Type' => 'application/json',
                ]);
            }

            if ($success) {
                DB::commit();
              

                return  response()->json([
                    'Collection was successfully updated to completed', 200
                    ])->withHeaders([
                        'Content-Type' => 'application/json',
                    ]);
            } else {
                DB::rollback();
                return response()->json([
                    'Something went wrong', 404
                    ])->withHeaders([
                        'Content-Type' => 'application/json',
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
