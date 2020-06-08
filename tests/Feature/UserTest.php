<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_name_is_hashed()
    {
                $this->Json('POST','api/auth/register')->assertJsonStructure(['name'=>[]]) ;

    }

    public function test_the_password_is_hashed()
    {
        $this->Json('POST','api/auth/register')->assertJsonStructure(['password'=>[]]) ;

    }

    public function test_the_email_is_hashed()
    {
        $this->Json('POST','api/auth/register')->assertJsonStructure(['email'=>[]]) ;

    }
    public function test_the_email_is_unique()
    {

        $this->assertDatabaseHas('users',[

            'email'=>'mostafa@mohamed',

        ]) ;

    }

    public function test_it_has_many_cart(){

        $user= User::find(9) ;

        $user->carts()->save(
            factory(ProductVariation::class)->create()
        ) ;

        $this->assertInstanceOf(ProductVariation::class,$user->carts->first());
    }
    public function test_every_user_has_quantity(){

        $user= User::find(9) ;



        $this->assertEquals(null,$user->carts->first()->pivot->quantity);
    }

    public function test_it_has_many_address(){
        $user =User::find(9) ;

        $user->addresses()->save(
            factory(Address::class)->make()
        );

        $this->assertInstanceOf(Address::class,$user->addresses->first());
    }

    public function test_it_has_paymentMethods(){
        $user=User::find(1);

        $user->paymentMethods()->save(
            PaymentMethod::find(1)
        );

        $this->assertInstanceOf(PaymentMethod::class,$user->paymentMethods->first());
    }
}
