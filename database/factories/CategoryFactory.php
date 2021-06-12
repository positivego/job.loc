<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'parent_id' => $this->faker->randomDigit(),
            'external_id' => $this->faker->randomNumber($nbDigits = 5, $strict = false),
            'created_at' => now(),
        ];
    }
}
