<?php

namespace App\Cart\Payments\Gateways ;

use App\Cart\Payments\Gateway;
use App\Models\User;
use Stripe\Customer as StripeCustomer;

class StripeGateway implements Gateway {

    protected $user;

    public function withUser(User $user)
    {
        // TODO: Implement withUser() method.

        $this->user =$user ;

        return $this ;
    }

    public function createCustomer()
    {
        // TODO: Implement createCustomer() method.



        if ($this->user->gateway_customer_id){
            return 'customer' ;
        }

//        $cutmomer = $this->createStripeCustomer() ;
//
//        dd($cutmomer);

        return new StripeGatewayCustomer();
    }

    protected function createStripeCustomer(){

        return StripeCustomer::create([
            'email'=>$this->user->email
        ]) ;
    }
}
