<?php

namespace App\Policies;

use App\Models\Estampa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstampaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo === 'F' || $user->tipo === 'A';
    }

    public function view(?User $user, Estampa $estampa)
    {
        return $estampa->cliente_id === null ? true : $estampa->cliente_id === $user->cliente->id;// ||$user->tipo === 'A' || $user->tipo === 'F';
    }

    public function viewPersonal(User $user){
        return $user->tipo === 'C';
    }

    public function viewPersonalStamps(User $user)
    {
        return $user->tipo != 'C';
    }
    public function viewCatalogue(?User $user){
        return $user == null || optional($user)->tipo === 'C';
    }

    public function create(User $user)
    {
        return $user->tipo === 'A' || $user->tipo === 'C';
    }

    public function update(User $user, Estampa $estampa)
    {
        return $user->tipo === 'A' && $estampa->cliente_id == null || $user->tipo === 'C' && $estampa->cliente_id === $user->cliente->id;
    }

    public function delete(User $user)
    {
        return $user->tipo === 'A' || $user->tipo === 'C';
    }

    public function restore(User $user)
    {
        return $user->tipo === 'A';
    }

    public function forceDelete(User $user, Estampa $estampa)
    {
       return false;
    }
}
