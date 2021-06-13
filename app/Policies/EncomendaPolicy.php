<?php

namespace App\Policies;

use App\Models\Encomenda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomendaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo === 'A' ||  $user->tipo === 'F';
    }


    public function view(User $user, Encomenda $encomenda)
    {
        return $user->tipo === 'A' ||  $user->tipo === 'F' || $user->id === $encomenda->cliente_id;
    }

    public function create(?User $user)
    {
        return $user == null || optional($user)->tipo === 'C';
    }

    public function update(User $user, Encomenda $encomenda)
    {
        return $user->tipo === 'A' || $user->id === $encomenda->cliente_id || $user->tipo === 'F';
    }

    public function delete(User $user, Encomenda $encomenda)
    {
        return $user->tipo === 'A';
    }

    public function restore(User $user, Encomenda $encomenda)
    {
        return false;
    }

    public function forceDelete(User $user, Encomenda $encomenda)
    {
        return false;
    }
}
