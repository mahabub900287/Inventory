<?php

namespace Database\Factories;

use App\Models\Bundle;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductShipment>
 */
class ProductShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isProduct = $this->faker->boolean;
        return [
            'product_id' => $isProduct ? Product::get()->random()->id : null,
            'bundle_id'  => !$isProduct ? Bundle::get()->random()->id : null,
            'shipment_id' => Shipment::get()->random()->id,
            'quantity'   => random_int(1, 5),
        ];
    }
}
