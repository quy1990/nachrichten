<?php

namespace Modules\Status\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Status\Entities\Status;

class StatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Status::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ["shipping", "pending", "paid", "refund"];

        return [
            'name' => $status[rand(0, 2)]
        ];
    }
}
