<?php

namespace App\Http\Middleware\Cart;

use App\Http\Controllers\Cart\Cart;
use Closure;
use Illuminate\Support\Facades\Auth;

class ResponseIfEmpty
{
    use Cart ;
    protected $user ;

    public function __construct()
    {
        $this->user =Auth::user() ;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->isEmpty()){
            return response()->json([
                'massage'=>'Cart i empty'
            ],400) ;
        }
        return $next($request);
    }
}
