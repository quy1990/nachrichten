<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use App\Models\Videos;
use Illuminate\Database\Seeder;

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
