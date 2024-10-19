<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'        => 'Company',
                'last_name'         => 'ITclanBD',
                'company_name'      => 'ITclanBD',
                'country'           => 'Bangladesh',
                'email'             => 'company@app.com',
                'password'          => Hash::make('12345678'),
                'type'              => 'company',
                'status'            => 'active',
                'phone'             => '+880 1301055093',
                'email_verified_at' => \Carbon\Carbon::now(),
            ],
            [
                'first_name'        => 'Mahabub',
                'last_name'         => 'Admin',
                'company_name'      => 'MahabubBd',
                'country'           => 'Bangladesh',
                'email'             => 'mahabub@app.com',
                'password'          => Hash::make('12345678'),
                'type'              => 'company',
                'status'            => 'active',
                'phone'             => '+880 1301055093',
                'email_verified_at' => \Carbon\Carbon::now(),
            ],
            [
                'first_name'        => 'Solaiman',
                'last_name'         => 'Admin',
                'company_name'      => 'Solaiman Dev',
                'country'           => 'Bangladesh',
                'email'             => 'solaiman@app.com',
                'password'          => Hash::make('12345678'),
                'type'              => 'company',
                'status'            => 'active',
                'phone'             => '+880 1301055093',
                'email_verified_at' => \Carbon\Carbon::now(),
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
