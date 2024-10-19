<?php

namespace Database\Seeders;

use App\Models\PackagingMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagingMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackagingMaterial::factory()->count(50)->create();
    }
}
