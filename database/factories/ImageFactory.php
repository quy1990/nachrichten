<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $arr = ['App\Models\Post', 'App\Models\User'];

        return [
            'url' => $this->faker->imageUrl,
            'imageable_id' => 1,
            'imageable_type' => $arr[rand(0, 1)]
        ];
    }
}
