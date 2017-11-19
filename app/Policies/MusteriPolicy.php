<?php

namespace App\Policies;

use App\Musteri;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MusteriPolicy
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
        return ($user->yetki == 'admin' ||  $user->yetkiler->musteri === true  );
    }

    public function create(User $user)
    {
        return ($user->yetki == 'admin' ||  $user->yetkiler->musteri === true  );
    }

    public function update(User $user, Musteri $musteri)
    {
        return ($user->yetki == 'admin' || $user->firma_id === $musteri->firma_id && $user->yetkiler->musteri === true  );
    }

    public function delete(User $user, Musteri $musteri)
    {
        return ($user->yetki == 'admin' || $user->firma_id === $musteri->firma_id && $user->yetkiler->musteri === true  );
    }
}
