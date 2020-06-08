<?php

namespace Tests\Feature;

use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_when_user_not_auth(){

        $this->json('POST','api/cart')->assertStatus(401) ;

    }
//    public function test_it_requires_products(){
//
//        $user=User::find(1) ;
//        $response = $this->jsonAs($user,'POST','api/cart')->assertJsonValidationErrors(['products']) ;
//
//    }

    public function test_it_fails_if_not_auth(){

        $this->json('PUT','api/cart/1')->assertStatus(401);
    }

    public function test_it_must_be_auth(){

        $this->json('GET','api/cart')->assertStatus(401) ;
    }


}
