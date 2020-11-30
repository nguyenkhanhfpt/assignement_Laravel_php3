<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('categories')->truncate();

        $data = [
            [
                'name' => 'Áo',
            ],
            [
                'name' => 'Quần',
            ],
            [
                'name' => 'Giày',
            ],
            [
                'name' => 'Mũ',
            ],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }

        Schema::enableForeignKeyConstraints();
    }
}
