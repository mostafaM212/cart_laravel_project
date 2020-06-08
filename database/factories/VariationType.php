<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ProductVariationType::class, function (Faker $faker) {
    return [
        'name'=>$faker->unique()->name
    ];
});
