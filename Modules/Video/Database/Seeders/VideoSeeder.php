<?php

namespace Modules\Video\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Video\Entities\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::factory()
            ->count(5)
            ->create();
    }
}
