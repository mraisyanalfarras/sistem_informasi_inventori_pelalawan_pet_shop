<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show employees');
    }

    public function create(User $user)
    {
        return $user->can('add employees');
    }

    public function update(User $user)
    {
        return $user->can('edit employees');
    }

    public function delete(User $user)
    {
        return $user->can('delete employees');
    }
}
