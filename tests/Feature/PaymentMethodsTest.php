<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PaymentMethodsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_default_value_true()
    {
        $payment =PaymentMethod::find(1) ;

        $this->assertEquals(0,$payment->default);
    }
//    public function test_default_make_another_default_value_false()
//    {
//        $user =User::find(1);
//
//        $oldAddress=factory(PaymentMethod::class)->create([
//            'user_id'=>1,
//            'default'=>true
//        ]);
//
//        $newAddress=factory(PaymentMethod::class)->create([
//            'user_id'=>1,
//            'default'=>true
//        ]);
//
//        $this->assertFalse($oldAddress->default);
//    }

    public function test_it_belongs_to_user(){
        $payment=PaymentMethod::find(1);

        $this->assertInstanceOf(User::class,$payment->user->first());
    }

    public function test_must_be_authinticate(){

        $this->json('GET','api/payment-methods')->assertStatus(401);
    }

    public function test_give_us_info(){
        $user =factory(User::class)->create();
        Auth::login($user);
        $this->json('api/payment-methods',$user)->assertJsonFragment(['id'=>1]);
    }
}
