<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'auth.me',
            'users.read', 'users.create', 'users.update', 'users.delete', 'users.activate', 'users.deactivate', 'users.reset_password', 'users.assign_role',
            'roles.read', 'roles.create', 'roles.update', 'roles.delete', 'roles.assign_permissions',
            'permissions.read', 'permissions.create', 'permissions.update', 'permissions.delete',
            'cities.read', 'cities.create', 'cities.update', 'cities.delete',
            'subcities.read', 'subcities.create', 'subcities.update', 'subcities.delete',
            'woredas.read', 'woredas.create', 'woredas.update', 'woredas.delete',
            'audit_logs.read',
            'reports.city', 'reports.subcity', 'reports.woreda', 'reports.officer', 'reports.customer',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'sanctum',
            ]);
        }

        $all = Permission::where('guard_name', 'sanctum')->pluck('name')->toArray();

        $roleMap = [
            'super_admin' => $all,
            'subcity_admin' => [
                'auth.me', 'users.read', 'users.create', 'users.update', 'users.activate', 'users.deactivate', 'users.reset_password', 'users.assign_role',
                'roles.read', 'permissions.read', 'subcities.read', 'woredas.read', 'reports.subcity', 'reports.woreda', 'audit_logs.read',
            ],
            'woreda_admin' => [
                'auth.me', 'users.read', 'users.create', 'users.update', 'users.activate', 'users.deactivate', 'users.reset_password', 'users.assign_role',
                'roles.read', 'permissions.read', 'woredas.read', 'reports.woreda', 'audit_logs.read',
            ],
            'city_front_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'city_back_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'subcity_front_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'subcity_back_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'woreda_front_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'woreda_back_officer' => ['auth.me', 'users.read', 'reports.officer'],
            'customer' => ['auth.me', 'reports.customer'],
        ];

        foreach ($roleMap as $roleName => $permissionsForRole) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'sanctum',
            ]);
            $role->syncPermissions($permissionsForRole);
        }

        $users = [
            ['name' => 'Super Admin', 'email' => 'superadmin@eservice.com', 'phone' => '0911000001', 'role' => 'super_admin'],
            ['name' => 'Subcity Admin', 'email' => 'subcity@eservice.com', 'phone' => '0911000002', 'role' => 'subcity_admin'],
            ['name' => 'Woreda Admin', 'email' => 'woreda@eservice.com', 'phone' => '0911000003', 'role' => 'woreda_admin'],
            ['name' => 'Front Officer', 'email' => 'frontofficer@eservice.com', 'phone' => '0911000004', 'role' => 'woreda_front_officer'],
            ['name' => 'Back Officer', 'email' => 'backofficer@eservice.com', 'phone' => '0911000005', 'role' => 'woreda_back_officer'],
            ['name' => 'Customer User', 'email' => 'customer@eservice.com', 'phone' => '0911000006', 'role' => 'customer'],
        ];

        foreach ($users as $seedUser) {
            $user = User::updateOrCreate(
                ['email' => $seedUser['email']],
                [
                    'name' => $seedUser['name'],
                    'phone' => $seedUser['phone'],
                    'password' => Hash::make('Password@123'),
                    'is_active' => true,
                ]
            );
            $user->syncRoles([$seedUser['role']]);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
