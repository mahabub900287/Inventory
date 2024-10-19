<?php

namespace Database\Seeders;

use App\Models\DeliveryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryProduct::factory()->count(50)->create();
    }
}
