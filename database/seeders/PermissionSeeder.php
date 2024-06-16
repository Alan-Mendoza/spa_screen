<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permission Access
            'permission-index',
            'permission-create',
            'permission-show',
            'permission-edit',
            'permission-destroy',

            // Role Access
            'role-index',
            'role-create',
            'role-show',
            'role-edit',
            'role-destroy',

            // User Access
            'user-index',
            'user-create',
            'user-show',
            'user-edit',
            'user-destroy',

            // Document Access
            'document-index',
            'document-create',
            'document-show',
            'document-edit',
            'document-destroy',

            // Post Access
            'post-index',
            'post-create',
            'post-show',
            'post-edit',
            'post-destroy',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
