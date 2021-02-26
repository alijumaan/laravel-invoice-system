<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ali',
            'email' => 'ali@ali.com',
            'email_verified_at' => now(),
            'password' => bcrypt('ali'),
            'remember_token' => Str::random(10),
        ]);
    }
}
