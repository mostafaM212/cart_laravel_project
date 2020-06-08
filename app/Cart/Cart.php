<?php
//
//namespace App\Cart ;
//
//
//use App\Models\User;
//
//class Cart {
//
//    protected $user ;
//    public function __construct(User $user)
//    {
//        dd($user) ;
//        $this->user =$user ;
//
//    }
//
//    public function add($products){
//
//        $products =  collect($products)->keyBy('id')->map(function ($product){
//            return [
//                'quantity' =>$product['quantity']
//            ];
//        })->toArray() ;
//
////        dd($products);
//
//        $this->user->carts()->syncWithoutDetaching($products) ;
//    }
//
//}
