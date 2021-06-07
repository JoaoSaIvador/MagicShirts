<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo === 'A';
    }

    public function view(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }


    public function delete(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }


    public function restore(User $user, User $model)
    {
        return $user->tipo === 'A';
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
