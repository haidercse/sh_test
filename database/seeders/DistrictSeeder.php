<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create([
            'district_name' => 'Gulsan',
            'division_id' => 1,
        ]);
        District::create([
            'district_name' => 'Mohaamadpur',
            'division_id' => 1,
        ]);
        District::create([
            'district_name' => 'chitagong district',
            'division_id' => 2,
        ]);
    }
}
