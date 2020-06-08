<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductIndexResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Scoping\Scopes\CategoryScope;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
//        dd($this->scopes());
        $products =Product::with(['variations.stocks'])->withScopes($this->scopes())->paginate(10);

        return ProductIndexResource::collection($products);
    }

    public function show(Product $product){
//        $product=Product::find($id) ;
//        dd($product);
        $product->load(['variations.type','variations.stocks','variations.product']) ;
        return new ProductResource($product) ;
    }

    protected function scopes(){
        return [
            'Category' => new CategoryScope()
        ] ;
    }
}
