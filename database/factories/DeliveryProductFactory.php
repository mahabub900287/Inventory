<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryProduct>
 */
class DeliveryProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'delivery_id'  => Delivery::get()->random()->id,
            'product_id' => Product::get()->random()->id,
            'quantity'   => random_int(1, 5),
            'tracking_number' => $this->faker->unique()->word,
        ];
    }
}
