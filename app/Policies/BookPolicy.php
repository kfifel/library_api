<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Permissions\BookPermissions;
use App\Permissions\RolePermissions;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class BookPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermissionTo(BookPermissions::READ)
            || $user->hasRole(RolePermissions::ADMIN);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(BookPermissions::CREATE)
            || $user->hasRole(RolePermissions::ADMIN);
    }

    public function update(User $user, Book $book)
    {
        return $user->hasPermissionTo(BookPermissions::UPDATE_ALL)
            || ( $user->hasPermissionTo(BookPermissions::UPDATE) && $book->user_id === $user->id )
            || $user->hasRole(RolePermissions::ADMIN);
    }

    public function delete(User $user, Book $book)
    {
        return $user->hasPermissionTo(BookPermissions::DELETE_ALL)
            || ($user->hasPermissionTo(BookPermissions::DELETE) && $book->user_id === $user->id)
            || $user->hasRole(RolePermissions::ADMIN);
    }
}
