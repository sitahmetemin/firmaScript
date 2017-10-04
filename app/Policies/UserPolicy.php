<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return ($user->yetki === 'admin' );
    }

    public function create(User $user)
    {
        return ($user->yetki === 'admin' );
    }

    public function update(User $user, User $userYetki)
    {
        return ($user->firma_id === $userYetki->firma_id && $userYetki->yetki === 'admin');
    }

    public function delete(User $user, User $userYetki)
    {
        return ($user->firma_id === $userYetki->firma_id && $userYetki->yetki === 'admin');
    }
}
