<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'slug' => Str::slug($faker->name),
        'description' => $faker->paragraph,
        'content' => $faker->paragraph,
        'image' => config('settings.default_img'),
    ];
});
