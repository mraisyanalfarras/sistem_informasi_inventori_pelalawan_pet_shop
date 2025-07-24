<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show users');
    }

    public function create(User $user)
    {
        return $user->can('add users');
    }

    public function update(User $user)
    {
        return $user->can('edit users');
    }

    public function delete(User $user)
    {
        return $user->can('delete users');
    }
}
