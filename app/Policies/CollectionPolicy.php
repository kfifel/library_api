<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\CollectionPermissions;
use App\Permissions\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @return void|bool
     */
//    public function before(User $user)
//    {
//        if ($user->hasRole(Role::ADMIN)) {
//            return true;
//        }
//    }


    public function view(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::READ);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::CREATE);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::UPDATE);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(CollectionPermissions::DELETE);
    }

}
