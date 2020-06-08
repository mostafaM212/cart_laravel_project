<?php

namespace App\Http\Middleware\Cart;

use App\Http\Controllers\Cart\Cart;
use Closure;
use Illuminate\Support\Facades\Auth;

class Sync
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
        $this->sync();
        if ($this->hasChanged()){
            return response()->json([
                'massage'=> 'oh no ,some items in your cart have changed ,please review this changes before reviewing your order'
            ],409);
        }
        return $next($request);
    }
}
