<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Delivery;
use App\Models\WareHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
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
            'delivery_type' => $this->faker->randomElement(['parcels', 'pallets']),
            'start_date' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+4 weeks'),
            'ref_number' => $this->faker->unique()->numberBetween(1,9000),
            'sender_name' => $this->faker->name,
            'sender_address' => $this->faker->address,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([Delivery::ANNOUNCED_STATUS]),
            'created_by' => User::all()->except(1)->random()->id
        ];
    }
}
