<?php

namespace Database\Seeders;

use App\Permissions\BookPermissions;
use App\Permissions\CategoryPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions of books
            Permission::create(['name' => BookPermissions::CREATE]);
            Permission::create(['name' => BookPermissions::READ]);
            Permission::create(['name' => BookPermissions::UPDATE]);
            Permission::create(['name' => BookPermissions::UPDATE_ALL]);
            Permission::create(['name' => BookPermissions::DELETE]);
            Permission::create(['name' => BookPermissions::DELETE_ALL]);

        // create permissions of categories
            Permission::create(['name' => CategoryPermissions::CREATE]);
            Permission::create(['name' => CategoryPermissions::READ]);
            Permission::create(['name' => CategoryPermissions::UPDATE]);
            Permission::create(['name' => CategoryPermissions::UPDATE_ALL]);
            Permission::create(['name' => CategoryPermissions::DELETE]);
            Permission::create(['name' => CategoryPermissions::DELETE_ALL]);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'receptionist']);
        $role->givePermissionTo([
            BookPermissions::CREATE,
            BookPermissions::READ,
            BookPermissions::UPDATE,
            BookPermissions::DELETE
        ]);

        // or may be done by chaining
        $role = Role::create(['name' => 'user'])
        ->givePermissionTo([BookPermissions::READ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
