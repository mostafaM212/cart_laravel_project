<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\ShippingMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_returns_data()
    {
        $this->json('GET','api/countries')->assertJsonFragment(['code'=>'AF']) ;

    }

    public function test_it_has_many_methods(){
        $country=Country::find(1) ;

        $this->assertInstanceOf(ShippingMethod::class,$country->shoppingMethods->first());
    }
}
