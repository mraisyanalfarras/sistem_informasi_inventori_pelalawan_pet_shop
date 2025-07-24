<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DataSir;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataSirPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('show datasirs');
    }

    public function create(User $user)
    {
        return $user->can('add datasirs');
    }

    public function update(User $user)
    {
        return $user->can('edit datasirs');
    }

    public function delete(User $user)
    {
        return $user->can('delete datasirs');
    }
}
