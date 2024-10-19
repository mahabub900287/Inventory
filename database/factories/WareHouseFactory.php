<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WareHouse>
 */
class WareHouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->name(),
            'serial_code' => $this->faker->unique()->numberBetween(1, 9000),
            'country_id'  => 1,
            'user_id'     => User::whereType('admin')->inRandomOrder()->first()->id,
            'email'       => $this->faker->unique()->safeEmail(),
            'phone'       => $this->faker->phoneNumber(),
            'city'        => $this->faker->city(),
            'street'      => $this->faker->streetName(),
            'state'       => $this->faker->state(),
            'post_code'   => $this->faker->postcode(),
            'additional'  => $this->faker->city . ', ' . $this->faker->state,
            'status'      => 'active',
        ];
    }
}
