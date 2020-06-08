<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationType extends Model
{
    //
    public function productVariations(){
        return $this->hasMany(ProductVariation::class,'product_variation_type_id','id') ;
    }
}
