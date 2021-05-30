<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->tipo === 'A';
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Categoria $categoria)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Categoria $categoria)
    {
        return false;
    }

    public function delete(User $user, Categoria $categoria)
    {
        return false;
    }

    public function restore(User $user, Categoria $categoria)
    {
        return false;
    }

    public function forceDelete(User $user, Categoria $categoria)
    {
        return false;
    }
}
