<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Leave;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeavePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show leaves');
    }

    public function create(User $user)
    {
        return $user->can('add leaves');
    }

    public function update(User $user)
    {
        return $user->can('edit leaves');
    }

    public function delete(User $user)
    {
        return $user->can('delete leaves');
    }
}
