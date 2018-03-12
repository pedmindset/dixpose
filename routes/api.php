<?php

use Illuminate\Http\Request;
use App\Models\Collection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


 Route::group(['prefix' => 'v1', 'middleware' => ['auth.basic.once', 'cors']], function () {

    Route::apiResource('collections', 'API\CustomerCollectionController', ['only' => [
        'index', 'show', 'update' ]
    ]);

    // Route::get('users/', function () {
    //     $collection = Collection::where('company_id', 1)
    //     ->where('id', 91)
    //     ->first();
    //     if($collection){
    //         return response()->json([$collection], 200);
    //     }
    // });

 });


 
