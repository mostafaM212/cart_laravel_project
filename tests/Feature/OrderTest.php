<?php

namespace Tests\Feature;

use App\Cart\Money;
use App\Models\Order;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_it_has_default_value()
//    {
//       $order=Order::take(1);
//        $this->assertEquals('pending',$order->status);
//
//    }

    public function test_user_must_be_authinticated()
    {
       $this->json('POST','api/orders')->assertStatus(401) ;

    }


    public function test_it_has_many()
    {

        $user=User::find(1) ;

       $this->assertInstanceOf(Order::class,$user->orders->first());
    }
//    public function test_it_has_many_address()
//    {
//
//        $order=Order::find(11) ;
//
//        $this->assertInstanceOf(ProductVariation::class,$order->products->first());
//    }
    public function test_it_fails_if_user_not_authinticated(){

        $this->json('GET','api/orders')->assertStatus(401) ;
    }

    public function test_it_returns_amoney_instance_for_subtotal(){

        $order =Order::find(29);

        $this->assertInstanceOf(Money::class,$order->subtotal);
    }

    public function test_it_returns_amoney_instance_for_total(){

        $order =Order::find(29);

        $this->assertInstanceOf(Money::class,$order->total());
    }

}
