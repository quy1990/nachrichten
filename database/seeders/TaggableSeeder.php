<?php

namespace Database\Seeders;

use App\Models\Taggable;
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
        Taggable::factory()
            ->count(5)
            ->create();
    }
}
