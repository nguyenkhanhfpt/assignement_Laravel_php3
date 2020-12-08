<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'slug' => Str::slug($faker->name),
        'category_id' => rand(1, 4),
        'name_product' => $faker->name,
        'price_product' => 20000,
        'sale' => 0,
        'quantity_product' => 20,
        'decscription' => $faker->name,
        'view' => 0,
        'nomination' => rand(0, 1),
        'date' => Carbon::now()
    ];
});


