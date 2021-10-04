<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Generator();
        foreach (User::all() as $user) {
            $user->roles()->attach($faker->numberBetween(1, Role::count()));
        }
    }
}
