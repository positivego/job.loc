<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->text($maxNbChars = 200),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 15000),
            'quantity' => $this->faker->randomDigit(),
            'external_id' => $this->faker->randomNumber($nbDigits = 5, $strict = false),
            'created_at' => now(),
        ];
    }
}
