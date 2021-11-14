<?php

namespace Modules\Tag\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Post\Entities\Post;
use Modules\Tag\Entities\Tag;
use Modules\Tag\Entities\Taggable;
use Modules\Video\Entities\Video;

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