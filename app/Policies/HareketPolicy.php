<?php

namespace App\Policies;

use App\Hareket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HareketPolicy
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
        return ($user->yetki == 'admin' ||  $user->yetkiler->hareket === true  );
    }

    public function create(User $user)
    {
        return ($user->yetki == 'admin' ||  $user->yetkiler->hareket === true );
    }

    public function update(User $user, Hareket $hareket)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $hareket->firma_id && $user->yetkiler->hareket === true );
    }

    public function delete(User $user, Hareket $hareket)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $hareket->firma_id && $user->yetkiler->hareket === true  );
    }
}
