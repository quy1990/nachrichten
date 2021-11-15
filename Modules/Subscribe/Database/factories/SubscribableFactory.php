<?php

namespace Modules\Subscribe\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Subscribe\Entities\Subscribable;

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
        $arr = ['App\Models\User', 'Modules\Post\Entities\Post', 'App\Models\Tag', 'App\Models\Video', 'Modules\Comment\Entities\Category', 'Modules\Comment\Entities\Comment'];

        return [
            'user_id' => 1,
            'subscribable_id' => 1,
            'subscribable_type' => $arr[rand(0, 5)]
        ];
    }
}
