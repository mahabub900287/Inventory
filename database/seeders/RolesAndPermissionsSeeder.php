<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Define  roles
        $roles = [
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Editor',
            ],
        ];
        // Define  permissions
        $permissions = [
            'Dashboard' => [
                'Dashboard Cards',
                'Dashboard Charts',
                'Dashboard Pie Charts',
            ],
            'Admin' => [
                'All Admins',
                'Create Admin',
                'Edit Admin',
                'Show Admin',
                'Delete Admin',
            ],
            'User' => [
                'All Users',
                'Create User',
                'Edit User',
                'Show User',
                'Delete User',
            ],
            'Ware-House' => [
                'All Ware-House',
                'Create Ware-House',
                'Edit Ware-House',
                'Show Ware-House',
                'Delete Ware-House',
            ],
            'Role' => [
                'All Roles',
                'Create Role',
                'Edit Role',
                'Delete Role',
            ],
            'Delivery' => [
                'All Delivery',
                'Create Delivery',
                'Edit Delivery',
                'Show Delivery',
                'Delete Delivery'
            ],
            'Shipment' => [
                'All Shipment',
                'Create Shipment',
                'Edit Shipment',
                'Show Shipment',
                'Delete Shipment'
            ],
            'Shipment Return' => [
                'Return Shipment',
            ],
        ];

        // create roles and permissions
        foreach ($roles as $role) {
            Role::create($role);
        }

        foreach ($permissions as $parent => $childs) {
            $id = Permission::create(['name' => $parent])->id;
            foreach ($childs as $child) {
                Permission::create([
                    'parent_id' => $id,
                    'name' => $child,
                ]);
            }
        }
    }
}
