<?php

namespace Database\Seeders;

use App\Models\Attachment;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attachment::create(
            [
                'user_id' => 1,
                'image' => 'image.png',
                'cv' => 'image.pdf',
            ]
        );
    }
}
