<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api') ;
    }

    public function action(Request $request){
        $user = User::where('api_token',$request->bearerToken())->first() ;
        return new PrivateUserResource($user) ;
    }
}
