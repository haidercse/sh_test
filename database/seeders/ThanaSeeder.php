<?php

namespace Database\Seeders;

use App\Models\Thana;
use Illuminate\Database\Seeder;

class ThanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thana::create([
            'division_id' => 1,
            'district_id' => 1,
            'thana_name' => 'mohamadpur thana'
        ]);
        Thana::create([
            'division_id' => 1,
            'district_id' => 1,
            'thana_name' => 'Gulsan thana'
        ]);
        Thana::create([
            'division_id' => 2,
            'district_id' => 2,
            'thana_name' => 'chittagong thana'
        ]);
    }
}
