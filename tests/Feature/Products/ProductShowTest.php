<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_that_return_data()
    {
        $product=factory(Product::class)->create();

        $this->json('GET','api/products/'.$product->slug)->assertJsonFragment([
            'name'=>$product->name
        ]);
    }
    public function test_show_fails_if_there_is_no_product()
    {

        $this->json('GET','api/products/skd')->assertStatus(404);
    }
}
