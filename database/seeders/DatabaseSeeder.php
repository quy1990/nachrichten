<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(SubscribableSeeder::class);
        $this->call(TaggableSeeder::class);
    }
}
