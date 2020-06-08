<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class MeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_user_not_auth(){
        $this->json('GET','api/auth/me')->assertStatus(401) ;
    }

    public function test_it_returns_user_auth_data(){
        $user =['email'=>'mostafa@mohamed','password'=>'62646284'] ;

        $this->jsonAs($user,'GET','api/auth/me')->assertJsonFragment(['email'=>'mostafa@mohamed']) ;
       // $this->json('GET','api/auth/me')->assertStatus(401) ;
    }
}
