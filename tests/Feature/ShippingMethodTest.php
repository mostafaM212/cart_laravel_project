<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\ShippingMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Cart\Money;
use Tests\TestCase;

class ShippingMethodTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_returns_a_money_instance_for_price()
    {
//        $shipping =factory(ShippingMethod::class)->create() ;
        $shipping=ShippingMethod::find(1);

        $this->assertInstanceOf(Money::class,$shipping->price);
    }

    public function test_it_belongs_to_many_countries()
    {
        $shipping =ShippingMethod::find(1);



        $this->assertInstanceOf(Country::class,$shipping->countries->first());
    }


}
