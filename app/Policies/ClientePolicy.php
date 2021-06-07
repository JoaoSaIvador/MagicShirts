<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo === 'A';
    }

    public function view(User $user, Cliente $cliente)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Cliente $cliente)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }

    public function delete(User $user, Cliente $cliente)
    {
        return $user->id === $model->id || $user->tipo === 'A';
    }

    public function restore(User $user, Cliente $cliente)
    {
        return $user->tipo === 'A';
    }

    public function forceDelete(User $user, Cliente $cliente)
    {
       return false;
    }
}
