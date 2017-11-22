<?php

namespace App\Policies;

use App\Birim;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BirimPolicy
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
        return ($user->yetki == 'admin' ||  $user->yetkiler->birim === true );
    }

    public function create(User $user)
    {
        return ( $user->yetki == 'admin' || $user->yetkiler->birim === true);
    }

    public function update(User $user, Birim $birim)
    {
        return ($user->yetki == 'admin' || $user->firma_id === $birim->firma_id && $user->yetkiler->birim === true );
    }

    public function delete(User $user, Birim $birim)
    {
        return ($user->yetki == 'admin' || $user->firma_id === $birim->firma_id && $user->yetkiler->birim === true || $user->yetki == 'admin' );
    }
}
