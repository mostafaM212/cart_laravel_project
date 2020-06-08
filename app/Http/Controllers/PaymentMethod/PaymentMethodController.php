<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Cart\Payments\Gateway;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodsResource;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //
    protected $gateway ;
    public function __construct(Gateway $gateway)
    {
        $this->middleware('auth:api') ;
        $this->gateway =$gateway ;
    }

    public function index(Request $request){

        return PaymentMethodsResource::collection($request->user()->paymentMethods);
    }

    public function store(Request $request){


        $cart = $this->gateway->withUser($request->user())
            ->createCustomer()
            ->addCart($request->token) ;

        dd($cart);
    }
}
