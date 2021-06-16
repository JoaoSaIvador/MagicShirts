<?php

namespace App\Policies;

use App\Models\Cor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CorPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
     {
        return $user->tipo === 'A';
     }


    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Cor $cor)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;

    public function update(User $user, Cor $cor)
    {
        return false;
    }

    public function delete(User $user, Cor $cor)
    {
        return false;
    }

    public function restore(User $user, Cor $cor)
    {
        return false;
    }

    public function forceDelete(User $user, Cor $cor)
    {
        return false;
    }
}
