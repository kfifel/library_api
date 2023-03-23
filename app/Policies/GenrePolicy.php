<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\GenrePermissions;
use App\Permissions\RolePermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::READ)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::CREATE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::UPDATE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::DELETE)
            || $user->hasRole(RolePermissions::RECEPTIONIST);
    }
}
