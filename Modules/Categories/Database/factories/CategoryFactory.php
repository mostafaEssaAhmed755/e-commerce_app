<?php

namespace Modules\Categories\Database\factories;

use Modules\Categories\Entities\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(100),
            'parent_id'   => 1,
            'menu'        => 1,
        ];
    }
}
