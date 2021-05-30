<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo == 'a';
    }

    public function view(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo == 'a';
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo == 'a';
    }


    public function delete(User $user, User $model)
    {
        return $user->id === $model->id || $user->tipo == 'a';
    }


    public function restore(User $user, User $model)
    {
        return $user->tipo == 'a';
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
