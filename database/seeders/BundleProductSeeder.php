<?php

namespace Database\Seeders;

use App\Models\BundleProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BundleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BundleProduct::factory()->count(10)->create();
    }
}
