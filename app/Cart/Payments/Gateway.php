<?php

namespace App\Cart\Payments ;

use App\Models\User;

interface Gateway {
    /*
     * send all user information up to stripe
     */
    public function withUser(User $user) ;
    public function createCustomer() ;

}
