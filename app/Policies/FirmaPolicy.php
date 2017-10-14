<?php

namespace App\Policies;

use App\Firma;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirmaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view(User $user)
    {
        return ($user->yetki === 'superAdmin' || $user->yetki === 'admin' );
    }

    public function create(User $user)
    {
        return ($user->yetki === 'superAdmin' );
    }

    public function update(User $user)
    {
        return ($user->yetki === 'superAdmin' );
    }

    public function delete(User $user)
    {
        return ($user->yetki === 'superAdmin' );
    }

}
