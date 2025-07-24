<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show roles');
    }

    public function create(User $user)
    {
        return $user->can('add roles');
    }

    public function update(User $user)
    {
        return $user->can('edit roles');
    }

    public function delete(User $user)
    {
        return $user->can('delete roles');
    }
}
