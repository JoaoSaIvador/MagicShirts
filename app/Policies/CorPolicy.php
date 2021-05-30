<?php

namespace App\Policies;

use App\Models\Cor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
       return true;
    }

    public function view(User $user, Cor $cor)
    {
       return true;
    }

    public function create(User $user)
    {
       return $user->tipo === 'A';
    }

    public function update(User $user, Cor $cor)
    {
        return $user->tipo === 'A';
    }

    public function delete(User $user, Cor $cor)
    {
        return $user->tipo === 'A';
    }

    public function restore(User $user, Cor $cor)
    {
        return $user->tipo === 'A';
    }

    public function forceDelete(User $user, Cor $cor)
    {
        return false;
    }
}
