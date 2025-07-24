<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DataSio;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataSioPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show datasios');
    }

    public function create(User $user)
    {
        return $user->can('add datasios');
    }

    public function update(User $user)
    {
        return $user->can('edit datasios');
    }

    public function delete(User $user)
    {
        return $user->can('delete datasios');
    }
}
