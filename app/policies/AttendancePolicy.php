<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendancePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show attendances');
    }

    public function create(User $user)
    {
        return $user->can('add attendances');
    }

    public function update(User $user)
    {
        return $user->can('edit attendances');
    }

    public function delete(User $user)
    {
        return $user->can('delete attendances');
    }
}
