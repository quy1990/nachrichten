<?php

namespace Modules\Subscribe\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Subscribe\Entities\Subscribable;

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
