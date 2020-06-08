<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //

    public function __construct(LoginRequest $request)
    {
        Auth::guard('api') ;

    }

    public function action(LoginRequest $request){

        if ( !Auth::attempt($request->only(['email','password'])) ){
            return response()->json([
                'error'=>[
                    'email'=>'this email is not found',

                ]
            ],422) ;
        }
        return (new PrivateUserResource($request->user()))->additional([
            'meta'=>[
                'token'=>$request->user()->api_token
            ]
        ]) ;
    }

}
