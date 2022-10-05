<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'name' => 'admin',
            'division_id' => 1,
            'district_id' => 1,
            'thana_id' => 1,
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'address' => Str::random(15),


        ]);
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'user_' . $i,
                'division_id' => 1,
                'district_id' => 1,
                'thana_id' => 1,
                'email' => 'user_' . $i . '_@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'address' => Str::random(15),
            ]);
        }
    }
}