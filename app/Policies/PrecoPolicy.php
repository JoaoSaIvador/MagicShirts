<?php

namespace App\Policies;

use App\Models\Preco;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrecoPolicy
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

    public function view(User $user, Preco $preco)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Preco $preco)
    {
        return false;
    }

    public function delete(User $user, Preco $preco)
    {
        return false;
    }

    public function restore(User $user, Preco $preco)
    {
        return false;
    }

    public function forceDelete(User $user, Preco $preco)
    {
       return false;
    }
}
