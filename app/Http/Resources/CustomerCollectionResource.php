<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Customer;
class CustomerCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        
        
        return [
            'collections' => $this->collection,
            'bins' => $this->bin,
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'email' => $this->email,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'ghanaGPS' => $this->ghana_gps,
            'address' => $this->address,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'radius' => $this->radius,
            'frequency' => $this->frequency,
            'collections' => $this->collection,
            'bins' => $this->bin,
           
            
            
        ];
    }


    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }

    
}
