<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            AddressSeeder::class,
            WareHouseSeeder::class,
            ProductSeeder::class,
            BundleSeeder::class,
            BundleProductSeeder::class,
            DeliverySeeder::class,
            DeliveryProductSeeder::class,
            // ShipmentSeeder::class,
            // ProductShipmentSeeder::class,
            // PackagingMaterialSeeder::class
        ]);
    }
}
