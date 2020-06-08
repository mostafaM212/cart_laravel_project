<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Resources\Cart\CartResource;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    use Cart ;
    protected $cart ;
    protected $user ;
    public function __construct()
    {
        $this->middleware('auth:api') ;
    }

    public function index(Request $request){
        // we see that the user table has relationship with which model
        //1from carts in user model to product in variation model *2*from carts in user model to product in variation model
        //then to variation method in productVariation then to stocks fun
        //                         user                 productVariationModel
        $request->user()->load(['carts.product','carts.product.variations.stocks','carts.stocks']);
        $this->user=$request->user() ;
        $this->sync();
//        dd($request->user());
        $total=$this->withShipping($request->shipping_method_id)->total()->formatted();
        app()->bind('total',$total);
        return (new CartResource($request->user()))->additional([
            'meta'=>[
                'Empty'=>$this->isEmpty(),
                'subTotal'=>$this->subTotal()->formatted(),
                'total'=> $this->withShipping($request->shipping_method_id)->total()->formatted()
            ]
        ]) ;
    }

    public function store(CartStoreRequest $request){
       if ($request->user() !== null){

               $this->user=$request->user() ;
               $this->add($request->products ) ;

       }

    }

    public function update(ProductVariation $productVariation,CartUpdateRequest $request){

        $this->user =Auth::user() ;
        $this->updateProduct($productVariation->id,$request->quantity) ;
    }

    public function destroy(ProductVariation $productVariation){

        $this->user = Auth::user();
        $this->delete( $productVariation->id);
    }



}
