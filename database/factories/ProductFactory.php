<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeMapping = [
            'Track Organic',
            'Track Lot & Expiry',
            'Fragile',
        ];

        $randomType1 = $this->faker->randomElement($typeMapping);
        $randomType2 = $this->faker->randomElement($typeMapping);

        return [
            'name' => $this->faker->unique()->word,
            'sku' => $this->faker->ean8,
            'type' => [$randomType1, $randomType2],
            'weight' => $this->faker->randomFloat(2, 0, 100),
            'barcode_type' => $this->faker->randomElement(['code-128', 'ean-13', 'gs1-128', 'qr-code']),
            'barcode_number' => $this->faker->isbn13,
            'description' => $this->faker->paragraph,
            'tariff_number' => $this->faker->word,
            'country_id' => Country::get()->random()->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_by' => User::all()->except(1)->random()->id

        ];
    }
}
