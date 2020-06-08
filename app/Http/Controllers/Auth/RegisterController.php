<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\PrivateUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function action(RegisterRequest $request){
        $user = User::create($request->only(['email','name','password'])) ;
        $user->api_token =Str::random(60) ;
        $user->save() ;

        return new PrivateUserResource($user) ;
    }
}
