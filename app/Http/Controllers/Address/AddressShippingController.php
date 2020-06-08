<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingMethodResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressShippingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api']) ;
     }

    public function action(Address $address){
        //return dd($address->country->shoppingMethods->first()) ;
        $this->authorize('show',$address) ;
        return ShoppingMethodResource::collection($address->country->shoppingMethods) ;
    }
}
