<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customerRole = Role::create(['name' => 'customer']);
        $merchantRole = Role::create(['name' => 'merchant']);

        $permissions = [
            'view',
            'create',
            'edit',
            'delete',
            'checkout'
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission]);

            if ($permission === 'checkout') {
                $customerRole->givePermissionTo($perm);
            } else {
                $merchantRole->givePermissionTo($perm);
            }
        }
    }
}
