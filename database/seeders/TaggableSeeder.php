<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Entities\Post;
use Modules\Category\Entities\Tag;
use Modules\Category\Entities\Taggable;
use Modules\Category\Entities\Video;

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
