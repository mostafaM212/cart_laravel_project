<?php

namespace Tests\Feature;

use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VariationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//

    public function test_it_returns_formatted_price(){
        $variations=factory(ProductVariation::class)->create([
            'price'=>100
        ]);
        $this->assertEquals(100,$variations->price->amount());
    }
    public function test_it_returns_product_price_if_price_was_null(){
        $product=factory(\App\Models\Product::class)->create() ;
       $product->variations()->save(
           $variations=factory(ProductVariation::class)->create([
               'price'=>null
           ])
       );
        $this->assertEquals($product->price->amount(),$variations->price->amount());
    }
    public function test_the_variation_price_is_not_equals_to_products(){
        $product=factory(\App\Models\Product::class)->create([
            'price'=>100
        ]) ;
        $product->variations()->save(
            $variations=factory(ProductVariation::class)->create([
                'price'=>1000
            ])
        );
        $this->assertEquals(true,$variations->priceVaries());
    }
    public function test_it_has_one_variation_type(){

        $variation=factory(ProductVariation::class)->create([
            'id'=>10
        ]);

        $variation->type()->save(
            factory(ProductVariation::class)->create()
        );

        $this->assertInstanceOf(ProductVariationType::class,$variation->type->first());
    }

    public function test_it_has_many_stocks(){
        $variation=factory(ProductVariation::class)->create() ;

        $variation->stocks()->save(
            factory(Stock::class)->create()
        );

        $this->assertInstanceOf(Stock::class,$variation->stocks->first());
    }

    public function test_it_has_stocks_quantity(){
        $variation=factory(ProductVariation::class)->create() ;

        $variation->stocks()->save(
            factory(Stock::class)->create([
                'quantity'=>100
            ])
        );

        $this->assertEquals(100,$variation->stokeCount());
    }
}
