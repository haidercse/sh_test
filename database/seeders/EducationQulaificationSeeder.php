<?php

namespace Database\Seeders;

use App\Models\EducationQualification;
use Illuminate\Database\Seeder;

class EducationQulaificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationQualification::create([
            'user_id' => 1,
            'exam_id' => 1,
            'university_id' => 1,
            'board_id' => 1,
            'result' => '4.00',
        ]);

    }
}
