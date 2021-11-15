<?php

namespace Modules\Menu\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Menu\Entities\Menu;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [

        ];
    }
}
