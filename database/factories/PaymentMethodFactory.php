<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\PaymentMethod::class, function (Faker $faker) {
    return [
        //
        'cart_type'=>$faker->creditCardType,
        'last_four'=>'4242',
        'provider_id'=>$faker->name
    ];
});
