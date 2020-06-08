<?php

namespace Tests\Unit\Products;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Models\Stock;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase ;
use Illuminate\Foundation\Testing\WithFaker ;

class ProductVariationTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function test_product_has_one_type()
//    {
//        $product=factory(ProductVariation::class)->create();
//
//       $this->assertInstanceOf(ProductVariationType::class,$product->type);
//    }
        public function test_it_has_many_stock(){
            $variation = factory(ProductVariation::class)->create();

            $variation->stocks()->save(
                factory(Stock::class)->make()
            );
            $this->assertInstanceOf(Stock::class,$variation->stocks->first());
        }
}
