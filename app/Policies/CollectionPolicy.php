<?php

namespace App\Policies;

use App\Models\Collection;
use App\Models\User;
use App\Permissions\CollectionPermissions;
use App\Permissions\RolePermissions;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::READ)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::CREATE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::UPDATE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::DELETE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

}
