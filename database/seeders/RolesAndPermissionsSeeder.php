<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Grouped Permissions
     * @var array|string[][]
     */
    private array $permissionGroups = [
        'Role' => [
            'View',
            'Add',
            'Edit',
            'Delete'
        ],
        'User' => [
            'View',
            'Add',
            'Edit',
            'Activate',
            'Deactivate'
        ],
        'Address' => [
            'View',
            'Add',
            'Edit',
            'Delete'
        ],
        'Country' => [
            'View',
            'Add',
            'Edit',
            'Delete'
        ],
        'Product' => [
            'View',
            'Add',
            'Edit',
            'Delete'
        ]
    ];

    /**
     * Roles with their permissions
     * @var array
     */
    private array $rolePermissions = [
        'Customer' => [
            'permissions' => [
                'Product : View', 'guard_name' => 'web'
            ]
        ],
        'Seller' => [
            'permissions' => [
                'Role : View',
                'Role : Add',
                'Role : Edit',
                'Role : Delete'
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin Role
        Role::updateOrCreate(['name' => 'Super Admin']);

        // Create Permissions
        foreach ($this->permissionGroups as $permissionGroupName => $permissionGroupPermissions) {
            foreach ($permissionGroupPermissions as $permission) {
                Permission::updateOrCreate(['guard_name' => 'web',
                    'name' => $permissionGroupName . ' : ' . $permission
                ]);
            }
        }

        // Create or update all other Roles with descriptions and permissions
        foreach ($this->rolePermissions as $roleName => $data) {

            $role = Role::updateOrCreate(['name' => $roleName]);

            foreach ($data['permissions'] as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
