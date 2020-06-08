<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str ;
//use App\Model;
use Faker\Generator as Faker;
use App\Models\Category ;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        //
        'name'=>$name= $faker->unique()->name,
        'slug'=>Str::slug($name)
    ];
});
