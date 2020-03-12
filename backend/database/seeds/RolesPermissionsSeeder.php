<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_role        = Role::create(['name' => 'super-admin']);
        $edit_globals_permission = Permission::create(['name' => 'edit globals']);
        $edit_users_permission2  = Permission::create(['name' => 'edit users']);
        $super_admin_role->givePermissionTo($edit_globals_permission);
        $super_admin_role->givePermissionTo($edit_users_permission2);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo($edit_users_permission2);
    }
}
