<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable=[
        'code','name'
    ];
    public $timestamps =false ;

    public function shoppingMethods(){
        return $this->belongsToMany(ShippingMethod::class,'country_shopping_method','country_id','shopping_method_id') ;
    }
}
