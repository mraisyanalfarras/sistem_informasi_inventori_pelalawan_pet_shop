<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payroll;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayrollPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show payrolls');
    }

    public function create(User $user)
    {
        return $user->can('add payrolls');
    }

    public function update(User $user)
    {
        return $user->can('edit payrolls');
    }

    public function delete(User $user)
    {
        return $user->can('delete payrolls');
    }
}
