<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions\GenrePermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::READ);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::CREATE);
    }

    public function update(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::UPDATE);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(GenrePermissions::DELETE);
    }
}
