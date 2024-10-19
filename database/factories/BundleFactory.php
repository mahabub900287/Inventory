<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bundle>
 */
class BundleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'sku' => $this->faker->ean8,
            'description' => $this->faker->paragraph,
            'tariff_number' => $this->faker->word,
            'country_id' => Country::get()->random()->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_by' => User::all()->except(1)->random()->id
        ];
    }
}
