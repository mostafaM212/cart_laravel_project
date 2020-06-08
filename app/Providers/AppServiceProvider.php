<?php

namespace App\Providers;

use App\Cart\Cart;
use App\Cart\Payments\Gateway;
use App\Cart\Payments\Gateways\StripeGateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */


    public function register()
    {
        //


//        $this->app->bind(Cart::class,function ($app){
//            dd(\auth()->check());
//            return new Cart($app->auth->user());
//        });

        $this->app->singleton(Gateway::class,function (){
            return new StripeGateway() ;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
