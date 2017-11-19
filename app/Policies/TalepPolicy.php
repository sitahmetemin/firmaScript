<?php

namespace App\Policies;

use App\Talep;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TalepPolicy
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
        return ($user->yetki == 'admin' ||  $user->yetkiler->talep === true );
    }

    public function create(User $user)
    {
        return ($user->yetki == 'admin' ||  $user->yetkiler->talep === true );
    }

    public function update(User $user, Talep $talep)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $talep->firma_id && $user->yetkiler->talep === true  );
    }

    public function delete(User $user, Talep $talep)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $talep->firma_id && $user->yetkiler->talep === true  );
    }
}
