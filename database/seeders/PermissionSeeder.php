<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Super Admin role
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);

        // Create Couple role (Story 1.2)
        Role::firstOrCreate(['name' => 'couple']);

        // Create permissions for admin actions
        $permissions = [
            'access_admin_dashboard',
            'create_wedding_accounts',
            'manage_weddings',
        ];

        foreach ($permissions as $permission) {
            $permissionModel = Permission::firstOrCreate(['name' => $permission]);
            $superAdminRole->givePermissionTo($permissionModel);
        }
    }
}
