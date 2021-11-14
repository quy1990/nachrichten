<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Entities\Comment;

class CommentSeeder extends Seeder
{

    public function run()
    {
        Comment::factory()
            ->count(5)
            ->create();
    }
}
