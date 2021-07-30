<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
        ];

        foreach ($adminPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Administrator']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $role = Role::create(['name' => 'User Normal']);
        $role->givePermissionTo([
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
        ]);
    }
}
