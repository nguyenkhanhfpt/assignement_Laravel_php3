<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            MemberSeeder::class,
            ProductSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
