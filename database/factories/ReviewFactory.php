<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "product_id"=>Product::all()->random()->id,
            "customer"=>$this->faker->name(),
            "review"=>$this->faker->paragraph(),
            "star"=>$this->faker->numberBetween(0,5)
        ];
    }
}
