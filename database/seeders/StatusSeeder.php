<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

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
