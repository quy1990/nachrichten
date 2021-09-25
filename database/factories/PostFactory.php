<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'body' => $this->faker->text(200),
            'user_id' => $this->faker->numberBetween(1,User::count()),
            'category_id' => $this->faker->numberBetween(1,Category::count()),
        ];
    }
}
