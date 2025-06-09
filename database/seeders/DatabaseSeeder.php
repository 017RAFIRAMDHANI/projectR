<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(1)->create();

        \App\Models\User::create([
            'name' =>  "Joy Boy",
            'email' => "ramdhanirafi15@gmail.com",
            'role' => "DHI",
            'email_verified_at' => now(),
            'password' =>  Hash::make('11111111'),
            'remember_token' => Str::random(10),
        ]);
    }
}
