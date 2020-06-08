<?php

namespace Tests\Feature;

use App\Models\ProductVariation;
use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class product extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
//    public function test(){
//        $product =factory(\App\Models\Product::class)->create() ;
//
//    }
//    public function test_it_has_stocks_quantity(){
//        $variation=factory(ProductVariation::class)->create() ;
//
//        $variation->stocks()->save(
//            factory(Stock::class)->create([
//                'quantity'=>100
//            ])
//        );
//
//        $this->assertEquals(100,$variation->stokeCount());
//    }
    public function test_miStock_fun(){

        $variation=new ProductVariation([
            'name'=>'Ahmed','price'=>100,'order'=>1
        ]);
        $variation->stocks()->save([
            'quantity'=>12
        ]);
        $variation->product()->save([
            'quantity'=>17
        ]);

        $this->assertEquals(12,$variation->minStock(17));
    }

}
