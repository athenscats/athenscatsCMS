<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'Edit posts']);
        Permission::create(['name' => 'Delete posts']);
        Permission::create(['name' => 'Create posts']);
        Permission::create(['name' => 'CRUD Taxonomy']);
        Permission::create(['name' => 'Administer roles & permissions']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Writer']);
        $role->givePermissionTo('Create posts', 'Delete posts', 'Edit posts');

        $role = Role::create(['name' => 'User']);

        $role = Role::create(['name' => 'Moderator']);
        $role->givePermissionTo(['Create posts', 'Delete posts', 'Edit posts', 'CRUD Taxonomy']);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Owner']);
        $role->givePermissionTo(Permission::all());
    }
}
