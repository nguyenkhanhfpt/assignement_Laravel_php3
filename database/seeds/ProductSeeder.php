<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        factory(Product::class, 20)->create()->each(function ($product) {
            for($i = 0; $i < 3; $i++) {
                $product->images()->create([
                    'image' => config('settings.default_product')
                ]);
            }
        });
    }
}
