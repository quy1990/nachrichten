<?php

namespace Database\Factories;

use App\Models\Taggable;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaggableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Taggable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $arr = ['App\Models\Post', 'App\Models\Tag', 'App\Models\Video'];

        return [
            'tag_id'        => 0,
            'taggable_id'   => 0,
            'taggable_type' => $arr[rand(0, 2)]
        ];
    }
}
