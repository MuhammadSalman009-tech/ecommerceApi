<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->word(),
            "detail"=>$this->faker->paragraph(),
            "price"=>$this->faker->numberBetween(50, 1000),
            "stock"=>$this->faker->randomDigit(),
            "discount"=>$this->faker->numberBetween(5, 20)
        ];
    }
}
