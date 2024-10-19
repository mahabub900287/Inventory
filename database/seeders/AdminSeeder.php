<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::updateOrCreate([
            'first_name'        => 'Admin',
            'last_name'         => 'ITclanBD',
            'email'             => 'admin@app.com',
            'country'           => 'Bangladesh',
            'password'          => Hash::make('12345678'),
            'type'              => 'admin',
            'status'            => 'active',
            'phone'             => '+880 1301055093',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        $role = Role::create(['name' => 'Super-Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
