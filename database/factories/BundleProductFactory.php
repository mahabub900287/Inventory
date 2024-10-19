<?php

namespace Database\Factories;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BundleProduct>
 */
class BundleProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bundle_id'  => Bundle::get()->random()->id,
            'product_id' => Product::get()->random()->id,
            'quantity'   => random_int(1, 5),
        ];
    }
}
