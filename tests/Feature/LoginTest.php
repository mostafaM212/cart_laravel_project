<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_returns_validation_error_fro_password()
    {
       $user =['email'=>'ahmed@ali'] ;

       $this->json('POST','api/auth/login')->assertJsonStructure(['password'=>[]]);
    }

    public function test_it_returns_validation_error_for_email()
    {
        $user =['email'=>'ahmed@ali'] ;

        $this->json('POST','api/auth/login')->assertJsonStructure(['password'=>[]]);
    }

    public function test_it_returns_email_error_for_wrong()
    {
        $user =['email'=>'ahmed@ali','password'=>'62646284'] ;

        $this->json('POST','api/auth/login',$user)->assertJsonStructure(['error'=>['email']]);
    }

    public function test_it_returns_token_for_user()
    {
        $user =['email'=>'mostafa@mohamed','password'=>'62646284'] ;

        $this->json('POST','api/auth/login',$user)->assertJsonStructure(['meta'=>[
            'token'
        ]
        ]);
    }

    public function test_it_returns_user_for_user()
    {
        $user =['email'=>'mostafa@mohamed','password'=>'62646284'] ;

        $this->json('POST','api/auth/login',$user)->assertJsonFragment([
            'email'=>$user['email']

        ]
        );
    }
    public function test_it_has_validation_error_for_password(){

        $user=['email'=>'mostafa@mohmed'] ;

        $this->json('POST','api/auth/login',$user)->assertJsonStructure(['password'=>[]]) ;
    }

    public function test_it_has_validation_error_for_email(){

        $user=['password'=>'mostafa@mohmed'] ;

        $this->json('POST','api/auth/login',$user)->assertJsonStructure(['email'=>[]]) ;
    }
}
