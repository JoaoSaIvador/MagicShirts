<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->tipo === 'A';
    }

    public function view(User $user)
    {
        return $user->tipo === 'C' || $user->tipo === 'A';
    }

    public function edit(User $user)
    {
        return $user->tipo === 'C' || $user->tipo === 'A';
    }

    public function update(User $user)
    {
        return $user->tipo === 'A';
    }


    public function delete(User $user)
    {
        return $user->tipo === 'A';
    }

    public function update_password(User $user)
    {
        $user->tipo === 'C' || $user->tipo === 'A';
    }

    public function restore(User $user)
    {
        return $user->tipo === 'A';
    }

    public function destroy_foto(User $user)
    {
        return $user->tipo === 'C' || $user->tipo === 'A';
    }
}
