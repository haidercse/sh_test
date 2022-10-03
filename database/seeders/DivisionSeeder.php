<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
           'division_name' => 'Dhaka',
        ]);
        Division::create([
            'division_name' => 'Chittagong',
         ]);
    }
}
