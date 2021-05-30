<?php

namespace App\Policies;

use App\Models\Preco;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrecoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Preco $preco)
    {
       return true;
    }

    public function create(User $user)
    {
        return $user->tipo ==='A';
    }

    public function update(User $user, Preco $preco)
    {
        return $user->tipo ==='A';
    }

    public function delete(User $user, Preco $preco)
    {
        return $user->tipo ==='A';
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
