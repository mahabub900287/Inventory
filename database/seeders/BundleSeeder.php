<?php

namespace Database\Seeders;

use App\Models\Bundle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bundle::factory()->count(10)->create();
    }
}
