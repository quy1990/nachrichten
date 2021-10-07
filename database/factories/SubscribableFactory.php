<?php

namespace Database\Factories;

use App\Models\Subscribable;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscribableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscribable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $arr = ['App\Models\User', 'App\Models\Post', 'App\Models\Tag', 'App\Models\Video', 'App\Models\Category', 'App\Models\Comment'];

        return [
            'user_id' => 1,
            'subscribable_id' => 1,
            'subscribable_type' => $arr[rand(0, 5)]
        ];
    }
}
