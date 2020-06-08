<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_it_show_collection_of_produsts()
//    {
//        $product=factory(Product::class)->create() ;
//
//        $this->json('GET','api/products')->assertJsonFragment([
//            'name'=>$product->name
//        ]);
//    }

//    public function test_it_has_paginated_data()
//    {
//        $this->json('GET','api/products')->assertJsonStructure([
//            'data','links'
//        ]);
//    }

    public function test_product_can_check_if_it_has_stock(){
        $product= factory(Product::class)->create();
        $product->variations()->save(
            $variation= factory(ProductVariation::class)->create()
        );
        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($product->inStock());
    }

    public function test_product_can_give_the_value_stock(){
        $product= factory(Product::class)->create();
        $product->variations()->save(
            $variation= factory(ProductVariation::class)->create()
        );
        $variation->stocks()->save(
            factory(Stock::class)->create([
                'quantity'=>100
            ])
        );

        $this->assertEquals(100,$product->stokeCount());
    }
}
