<?php

namespace Modules\Image\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Image\Entities\Image;

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
            'url'            => $this->faker->imageUrl,
            'imageable_id'   => 1,
            'imageable_type' => $arr[rand(0, 1)]
        ];
    }
}
