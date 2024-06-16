<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // User
        $user_permissions = $admin_permissions->filter(function($permission) {
            return substr($permission->name, 0, 5) != 'user-' &&
                   substr($permission->name, 0, 5) != 'role-' &&
                   substr($permission->name, 0, 11) != 'permission-' &&
                   substr($permission->name, 0, 9) != 'document-' &&
                   substr($permission->name, 0, 5) != 'post-';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
