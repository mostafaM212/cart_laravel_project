<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' =>$this->id ,
            'status'=>$this->status,
            'created_at'=>$this->created_at->toDateTimeString(),
            'subTotal'=>$this->subtotal->formatted(),
            'total'=>$this->total()->formatted(),
            'products'=>ProductVariationResource::collection($this->products),
            'address'=>new AddressResource($this->address),
            'shipping_method'=>new ShoppingMethodResource($this->shipping_method)

        ];
    }
}
