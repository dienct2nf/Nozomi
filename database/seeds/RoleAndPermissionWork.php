<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionWork extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        Permission::create(['name' => 'work-create', 'description' => 'admin create']);
        Permission::create(['name' => 'work-edit', 'description' => 'admin edit']);
        Permission::create(['name' => 'work-show', 'description' => 'admin show']);
        Permission::create(['name' => 'work-delete', 'description' => 'admin delete']);
        // create roles and assign created permissions

        // or may be done by chaining
        $role = Role::create(['name' => 'Work', 'description' => 'Work permisson'])
            ->givePermissionTo(['work-create', 'work-edit', 'work-show', 'work-delete']);
        $role = Role::create(['name' => 'Work only view', 'description' => 'Work only view permisson'])
            ->givePermissionTo(['work-show']);

    }
}
