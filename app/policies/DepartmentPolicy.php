<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show departments');
    }

    public function create(User $user)
    {
        return $user->can('add departments');
    }

    public function update(User $user)
    {
        return $user->can('edit departments');
    }

    public function delete(User $user)
    {
        return $user->can('delete departments');
    }
}
