<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if($this->resource instanceof Collection){
            return ProductVariationResource::collection($this->resource) ;
        }
        /*
         * it doesnot work because he was looking for the keys id and name and price inside collection
         * because every item is of this collection is collection itselfe so we need to  ProductVariationResource::collection($this->resource)
         * to send this collection to our resource
         * meaning that is if our resource was inside this collection we send it to the same resource in collection
         */

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->formattedPrice,
            'product_varies'=>$this->priceVaries(),
            'stock_count'=>$this->stokeCount(),
            'in_stoke' =>$this->inStock(),
            'product'=> new ProductIndexResource($this->product)
        ];
    }
}
