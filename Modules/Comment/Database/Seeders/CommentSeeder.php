<?php

namespace Modules\Comment\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Comment\Entities\Comment;

class CommentSeeder extends Seeder
{

    public function run()
    {
        Comment::factory()
            ->count(5)
            ->create();
    }
}
