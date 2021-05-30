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
        return false;
    }

    public function view(User $user, Estampa $estampa)
    {
        return $estampa->client_id === null || $estampa->client_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->tipo === 'A' || $user->tipo === 'C';
    }

    public function update(User $user, Estampa $estampa)
    {
        return $user->tipo === 'A' || $user->tipo === 'C';
    }

    public function delete(User $user, Estampa $estampa)
    {
        return $user->tipo === 'A' || $user->tipo === 'C';
    }

    public function restore(User $user, Estampa $estampa)
    {
       return false;
    }

    public function forceDelete(User $user, Estampa $estampa)
    {
       return false;
    }
}
