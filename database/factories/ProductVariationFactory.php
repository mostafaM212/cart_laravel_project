<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\ProductVariation ;
$factory->define(ProductVariation::class, function (Faker $faker) {
    return [
        //
        'name'=>$faker->unique()->name,
        'product_id'=>factory(\App\Models\Product::class)->create()->id,
        'product_variation_type_id'=>factory(\App\Models\ProductVariationType::class)->create()->id
    ];
});
