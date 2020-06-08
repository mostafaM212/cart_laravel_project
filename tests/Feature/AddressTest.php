<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_has_one_country()
    {
        $address =factory(Address::class)->create() ;


        $this->assertInstanceOf(Country::class,$address->country->first());

    }

    public function test_it_fails_if_unauthinticated(){

        $this->json('POST','api/addresses')->assertStatus(401);
    }

    public function test_it_has_validation_error_for_name(){
        $user=User::find(1);
        auth()->login($user);
        $this->json('POST','api/addresses')->assertJsonMissingValidationErrors(['name']) ;
    }


    public function test_it_has_validation_error_for_address_1(){
        $user=User::find(1);
        auth()->login($user);
        $this->json('POST','api/addresses')->assertJsonMissingValidationErrors(['address_1']) ;
    }


    public function test_it_has_validation_error_for_city(){
        $user=User::find(1);
        auth()->login($user);
        $this->json('POST','api/addresses')->assertJsonMissingValidationErrors(['city']) ;
    }
    public function test_it_has_validation_error_for_postal_code(){
        $user=User::find(1);
        auth()->login($user);
        $this->json('POST','api/addresses')->assertJsonMissingValidationErrors(['postal_code']) ;
    }
    public function test_it_has_validation_error_for_country_id(){
        $user=User::find(1);
        auth()->login($user);
        $this->json('POST','api/addresses')->assertJsonMissingValidationErrors(['country_id']) ;
    }

    public function test_it_has_stores_data_for_address(){
        $user=User::find(1);
        auth()->login($user);

        $this->json('POST','api/addresses',[
            'name'=>'Alexc','postal_code'=>'waeff','city'=>'kjbkb','country_id'=>5,'address_1'=>'egeeg'
        ]) ;
        $this->assertDatabaseHas('addresses',[
            'user_id'=>1
        ]) ;
    }
//    public function test_it_has_returns_address(){
//        $user=User::find(1);
//        auth()->login($user);
//
//        $response= $this->json('POST','api/addresses',[
//            'name'=>'Alexc','postal_code'=>'waeff','city'=>'kjbkb','country_id'=>5,'address_1'=>'egeeg'
//        ]);
//        $response->assertJsonStructure([
//            'data'=>[]
//        ]) ;
//    }
    public function test_it_set_the_old_address_to_be_false(){

        $user =User::find(1);

        Auth::login($user);

        $oldAddress= factory(Address::class)->create([
            'default'=>true,
            'user_id'=>1
        ]);
        factory(Address::class)->create([
            'default'=>true,
            'user_id'=>1
        ]);

        $this->assertEquals(0,$oldAddress->fresh()->default);

    }
}
