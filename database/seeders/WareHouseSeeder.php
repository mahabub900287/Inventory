<?php

namespace Database\Seeders;

use App\Models\WareHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WareHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WareHouse::factory()->count(2)->create();
    }
}
