<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User; // Pastikan User terimport

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permission
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principals',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];

        // Membuat permission
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission
                ]
            );
        }

        // Membuat role designer_manager dan mengaitkan permission
        $designManagerRole = Role::firstOrCreate([
            'name' => 'designer_manager'
        ]);

        $designManagerPermissions = [
            'manage products',
            'manage principals',
            'manage testimonials',
        ];
        $designManagerRole->syncPermissions($designManagerPermissions);

        // Membuat role super_admin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        // Membuat user dan memberikan role
        $user = User::create([
            'name' => 'ShaynaComp',
            'email' => 'super@admin.com',
            'password' => bcrypt('123123123')
        ]);

        // Menetapkan role kepada user
        $user->assignRole('super_admin');
    }
}
