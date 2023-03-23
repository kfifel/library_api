<?php

namespace Database\Seeders;

use App\Permissions\BookPermissions;
use App\Permissions\CollectionPermissions;
use App\Permissions\GenrePermissions;
use App\Permissions\Role as UsersRole;
use App\Permissions\RolePermissions;
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
            Permission::create(['name' => BookPermissions::CREATE ]);
            Permission::create(['name' => BookPermissions::READ]);
            Permission::create(['name' => BookPermissions::UPDATE, ]);
            Permission::create(['name' => BookPermissions::UPDATE_ALL, ]);
            Permission::create(['name' => BookPermissions::DELETE, ]);
            Permission::create(['name' => BookPermissions::DELETE_ALL, ]);

        // create permissions of genres
            Permission::create(['name' => GenrePermissions::CREATE, ]);
            Permission::create(['name' => GenrePermissions::READ, ]);
            Permission::create(['name' => GenrePermissions::UPDATE, ]);
            Permission::create(['name' => GenrePermissions::DELETE, ]);

        // create permissions of collections
            Permission::create(['name' => CollectionPermissions::CREATE, ]);
            Permission::create(['name' => CollectionPermissions::READ, ]);
            Permission::create(['name' => CollectionPermissions::UPDATE, ]);
            Permission::create(['name' => CollectionPermissions::DELETE, ]);

        // create permissions of RolePermissions
            Permission::create(['name' => RolePermissions::ASSIGN_ROLE ]);
            Permission::create(['name' => RolePermissions::ASSIGN_PERMISSION ]);
            Permission::create(['name' => RolePermissions::REVOKE_ROLE ]);
            Permission::create(['name' => RolePermissions::REVOKE_PERMISSION ]);


        // create roles and assign created permissions
        // this can be done as separate statements
        $role = Role::create(['name' => UsersRole::RECEPTIONIST, ]);
        $role->givePermissionTo([
            BookPermissions::CREATE,
            BookPermissions::READ,
            BookPermissions::UPDATE,
            BookPermissions::DELETE,

            GenrePermissions::READ,

            CollectionPermissions::READ,
        ]);

        // or may be done by chaining
        $role = Role::create(['name' => UsersRole::USER, ]);
        $role->givePermissionTo([BookPermissions::READ]);

        $role = Role::create(['name' => UsersRole::ADMIN, ]);
        $role->givePermissionTo([
            BookPermissions::UPDATE_ALL,
            BookPermissions::DELETE_ALL,

            GenrePermissions::CREATE,
            GenrePermissions::READ,
            GenrePermissions::UPDATE,
            GenrePermissions::DELETE,

            CollectionPermissions::CREATE,
            CollectionPermissions::READ,
            CollectionPermissions::UPDATE,
            CollectionPermissions::DELETE,

            RolePermissions::ASSIGN_PERMISSION,
            RolePermissions::REVOKE_PERMISSION,
            RolePermissions::ASSIGN_ROLE,
            RolePermissions::REVOKE_ROLE,
        ]);
    }
}
