<?php

namespace Modules\Status\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Status\Entities\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['shipping', 'paid', 'done'];
        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
