<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use Modules\Category\Entities\Role;
use Modules\Image\Entities\User;

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
