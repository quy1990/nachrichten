<?php

namespace Modules\Tag\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Tag\Entities\Taggable;

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
