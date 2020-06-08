<?php

namespace App\Http\Resources;

use App\Models\ProductVariation;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends ProductIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //look
        return array_merge(parent::toArray($request),[
            'variation'=>ProductVariationResource::collection($this->variations->groupBy('type.name'))
        ]);
    }
}
