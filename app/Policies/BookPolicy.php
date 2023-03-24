<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Permissions\BookPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->hasPermissionTo(BookPermissions::READ)
            ? Response::allow()
            : Response::deny('You can\'t view this books');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(BookPermissions::CREATE);
    }

    public function update(User $user, Book $book)
    {
        return $user->hasPermissionTo(BookPermissions::UPDATE_ALL)
            || ( $user->hasPermissionTo(BookPermissions::UPDATE) && $book->user_id === $user->id );
    }

    public function delete(User $user, Book $book)
    {
        return $user->hasPermissionTo(BookPermissions::DELETE_ALL)
            || ($user->hasPermissionTo(BookPermissions::DELETE) && $book->user_id === $user->id);
    }
}
