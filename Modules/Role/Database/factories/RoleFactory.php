<?php

namespace Modules\Role\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Role\Entities\Role;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
