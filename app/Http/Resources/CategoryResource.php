<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * of json data we choose that display only
     *name and slug
     * and we make $this to make it an dinamic data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'slug'=>$this->slug,
            'children'=>CategoryResource::collection(
                $this->whenLoaded('children')
            )
        ];
    }

}
