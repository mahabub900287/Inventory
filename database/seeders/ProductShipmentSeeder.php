<?php

namespace Database\Seeders;

use App\Models\ProductShipment;
use App\Models\Shipment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductShipment::factory()->count(50)->create();
    }
}
