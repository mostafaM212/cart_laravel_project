<?php

namespace Tests\Unit;

use App\Models\ProductVariation;
use App\Models\Stock;
use PHPUnit\Framework\TestCase;

class VariationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
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
