<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use App\Http\Controllers\Cart\Cart;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class EmptyOrder
{
    use Cart ;
    protected $user ;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->user =Auth::user() ;
        
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        //
        $this->emptyCart();
    }
}
