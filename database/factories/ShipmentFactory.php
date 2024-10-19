<?php

namespace Database\Factories;

use App\Models\CustomerAddress;
use App\Models\User;
use App\Models\WareHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'warehouse_id'  => WareHouse::get()->random()->id,
            'customer_address_id'  => CustomerAddress::get()->random()->id,
            'preview_picks' => $this->faker->boolean,
            'order_number' => $this->faker->unique()->randomNumber(5),
            'invoice_number' => $this->faker->unique()->randomNumber(5),
            'type_of_good' => $this->faker->word,
            'type' => $this->faker->randomElement(['product', 'bundle']),
            'note' => $this->faker->sentence,
            'created_by' => User::all()->except(1)->random()->id,
            'updated_by' => User::all()->except(1)->random()->id
        ];
    }
}
