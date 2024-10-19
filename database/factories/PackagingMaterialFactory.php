<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackagingMaterial>
 */
class PackagingMaterialFactory extends Factory
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
            'sku' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement(['box', 'envelope']),
            'masurement' => json_encode(['width' => $this->faker->randomFloat(2, 0, 100), 'height' => $this->faker->randomFloat(2, 0, 100)]),
            'barcode_type' => $this->faker->randomElement(['code-128', 'ean-13', 'gs1-128', 'qr-code']),
            'barcode_number' => $this->faker->unique()->word,
            'reorder_point' => $this->faker->numberBetween(1, 1000),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
