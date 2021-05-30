<?php

namespace App\Policies;

use App\Models\Tshirt;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TshirtPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
       return true;
    }


    public function view(User $user, Tshirt $tshirt)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->tipo ==='A';
    }

    public function update(User $user, Tshirt $tshirt)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function delete(User $user, Tshirt $tshirt)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function restore(User $user, Tshirt $tshirt)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tshirt  $tshirt
     * @return mixed
     */
    public function forceDelete(User $user, Tshirt $tshirt)
    {
        //
    }
}
