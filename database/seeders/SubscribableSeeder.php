<?php

namespace Database\Seeders;

use App\Models\Subscribable;
use Illuminate\Database\Seeder;

class SubscribableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscribable::factory()
            ->count(5)
            ->create();
    }
}
