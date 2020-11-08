<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'slug' => Helper::vn_to_eng($faker->name),
        'category_id' => rand(1, 4),
        'name_product' => $faker->name,
        'price_product' => 20000,
        'sale' => 0,
        'quantity_product' => 20,
        'decscription' => $faker->name,
        'view' => 0,
        'nomination' => 0,
        'date' => Carbon::now()
    ];
});


