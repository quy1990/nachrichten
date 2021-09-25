<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\role;
use App\Models\User;
use Illuminate\Database\Seeder;
use function GuzzleHttp\Promise\all;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()
            ->count(5)
            ->create();
    }
}
