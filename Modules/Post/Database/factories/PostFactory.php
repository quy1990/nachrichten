<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Post;
use Modules\Comment\Entities\Status;
use Modules\Comment\Entities\User;

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
        User::factory()->create();
        Category::factory()->create();
        Status::factory(5)->create();
        return [
            'title'       => $this->faker->name(),
            'body'        => $this->faker->text(200),
            'created_by'  => $this->faker->numberBetween(1, User::count()),
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'status_id'   => $this->faker->numberBetween(1, Status::count()),
        ];
    }
}
