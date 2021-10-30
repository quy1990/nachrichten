<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Video;
use Illuminate\Database\Seeder;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(5)
            ->create();
        Tag::factory()
            ->count(5)
            ->create();
        Video::factory()
            ->count(5)
            ->create();
        Taggable::factory()
            ->count(5)
            ->create();
    }
}
