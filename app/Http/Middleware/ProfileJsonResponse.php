<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ProfileJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response =$next($request) ;

        if ($response instanceof JsonResponse && app('debugbar')->isEnabled() && $request->has('_debug') ){

            $response->setData(array_merge( $response->getData(true) ,[
                    '_debugbar'=>array_intersect_key(app('debugbar')->getData(),['queries'=>''])
                ]));
        }

        return $response ;
    }
}
