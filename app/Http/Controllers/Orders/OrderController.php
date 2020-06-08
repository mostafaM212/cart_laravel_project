<?php

namespace App\Http\Controllers\Orders;

use App\Events\Order\OrderCreated;
use App\Http\Controllers\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    use Cart ;
    protected $user ;
    public function __construct()
    {
        $this->middleware(['auth:api']) ;
        $this->middleware(['auth:api','cart.sync','cart.filled'])->only('store') ;
    }

    public function index(Request $request){

        $orders =$request->user()->orders()
            ->with(['products','products.stocks','products.type','products.product','products.product.variations.stocks','address'])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders) ;

    }

    public function store(OrderStoreRequest $request){
        $this->user =$request->user() ;

        dd($request->all());
        $order = $this->storeOrder($request)    ;

        $order->products()->sync($this->products()->forSyncing()) ;

        event(new OrderCreated($order));

        return new OrderResource($order) ;

    }

    public function storeOrder(Request $request){
        $this->sync();
        return  $request->user()->orders()->create([
            'address_id'=>$request->address_id,
            'subtotal'=>$this->total()->amount(),
            'shipping_method_id'=>$request->shipping_method_id,
            'payment_method_id'=>$request->payment_method_id
        ]);
    }

}
