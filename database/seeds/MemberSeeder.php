<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name_member' => 'Admin',
            'email' => config('settings.mail_admin'),
            'password' => Hash::make(12345678),
            'role' => 1
        ]);
    }
}
