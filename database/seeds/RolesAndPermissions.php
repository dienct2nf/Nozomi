<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
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
        Permission::create(['name' => 'admin-create', 'description' => 'admin create']);
        Permission::create(['name' => 'admin-edit', 'description' => 'admin edit']);
        Permission::create(['name' => 'admin-show', 'description' => 'admin show']);
        Permission::create(['name' => 'admin-delete', 'description' => 'admin delete']);
        Permission::create(['name' => 'article-create', 'description' => 'article create']);
        Permission::create(['name' => 'article-edit', 'description' => 'article edit']);
        Permission::create(['name' => 'article-show', 'description' => 'article show']);
        Permission::create(['name' => 'article-delete', 'description' => 'article delete']);
        Permission::create(['name' => 'media-show', 'description' => 'media show']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Media', 'description' => 'media permisson']);
        $role->givePermissionTo('media-show');

        // or may be done by chaining
        $role = Role::create(['name' => 'Article', 'description' => 'media permisson'])
            ->givePermissionTo(['article-create', 'article-edit', 'article-show', 'article-delete']);

        $role = Role::create(['name' => 'Administrator', 'description' => 'full admin permission']);
        $role->givePermissionTo(Permission::all());
    }
}
