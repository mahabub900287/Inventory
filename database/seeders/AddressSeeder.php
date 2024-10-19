<?php

namespace Database\Seeders;

use App\Models\CustomerAddress;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
            [
                'country_id'        => 1,
                'user_id'           => 1,
                'street'            => 'Mazar Road',
                'phone'             => '+880 1301055093',
                'additional'        => 'Mazar Road, Dhaka',
                'post_code'         => 32423,
                'city'              => 'Uttora',
                'state'             => 'Dhaka',
                'company_name'      => 'ITclanBD',
                'company_phone'      => '0123456789',
                'company_email'      => 'info@app.com',
            ],
            [
                'country_id'        => 2,
                'user_id'           => 2,
                'street'            => 'Dokhin Khan',
                'phone'             => '+880 1301235093',
                'additional'        => 'Mazar Road, Dhaka',
                'post_code'         => 32423,
                'city'              => 'Danmondi',
                'state'             => 'Dhaka',
                'company_name'      => '6Amazon',
                'company_phone'      => '0342345678',
                'company_email'      => 'amazon@app.com',
            ],
        ];
        foreach ($address as $item) {
            CustomerAddress::create($item);
        }
    }
}
