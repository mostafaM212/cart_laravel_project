<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AddressShippingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_user_not_auth()
    {
        $user=User::find(1) ;

        $this->json('GET','api/auth/addresses/1/shipping')->assertStatus(401) ;
    }

    public function test_it_fails_if_address_not_found()
    {
        $user=User::find(1) ;

        $this->json('GET','api/auth/addresses/1/shipping')->assertJsonFragment(['name'=>'UPS']) ;
    }
}
