<?php


namespace App\Http\Controllers\Cart;


use App\Cart\Money;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Auth;

trait Cart
{
    protected $changed  ;

    protected $shipping ;
    public function withShipping($shippingId){
        $this->shipping =ShippingMethod::find($shippingId) ;

        return $this ;
    }

    protected function add($products){
        $this->user->carts()->syncWithoutDetaching(
            $this->getStorePayLoad($products)
        ) ;
    }

    protected function getStorePayLoad($products){

        return  collect($products)->keyBy('id')->map(function ($product){
            return [
                'quantity' =>$product['quantity'] + $this->getCurrentQuantity($product['id'])
            ];
        })->toArray() ;

    }

    protected function updateProduct($productId ,$quantity){

        $this->user->carts()->updateExistingPivot($productId,[
            'quantity'=>$quantity
        ]) ;
    }

    protected function getCurrentQuantity($productId){

        if ($product =$this->user->carts->where('id',$productId)->first()){

            return $product->pivot->quantity ;
        }
        return 0 ;
    }


    protected function delete($productId){

        $this->user->carts()->detach($productId) ;

    }

    protected function emptyCart(){

        $this->user->carts()->detach() ;

    }

    protected function isEmpty(){
        return $this->user->carts->sum('pivot.quantity') <= 0 ;
    }

    public function empty(){

        $this->user = Auth::user() ;
        $this->emptyCart() ;
    }

    protected function subTotal(){

        $total = $this->user->carts->sum(function ($product){
            return $product->pivot->quantity * $product->price->amount();
        });

        return new Money($total) ;

    }
    protected function total(){

        if ($this->shipping){
            return $this->subTotal()->add($this->shipping->price) ;
        }

        return $this->subTotal() ;
    }

    public function sync(){

        $this->user->carts->each(function ($product){
            //min quantity
            //update pivot
            $quantity =$product->minStock($product->pivot->quantity);
//            dd($quantity);
            if ($quantity !== $product->pivot->quantity){
                $this->changed = true ;
            }

            app()->bind('changed',function ()use ($quantity,$product){
                return $quantity !== $product->pivot->quantity ;
            }) ;
            $product->pivot->update([
                'quantity' => $quantity
            ]);
        });
    }

    public function products(){
        return $this->user->carts;
    }

    public function hasChanged(){
        return $this->changed ;
    }

}
