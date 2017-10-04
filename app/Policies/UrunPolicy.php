<?php

namespace App\Policies;

use App\Urun;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UrunPolicy
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
        return ($user->yetkiler->urun === true  );
    }

    public function create(User $user)
    {
        return ( $user->yetkiler->urun === true  );
    }

    public function update(User $user, Urun $urun)
    {
        return ($user->firma_id === $urun->firma_id && $user->yetkiler->urun === true  );
    }

    public function delete(User $user, Urun $urun)
    {
        return ($user->firma_id === $urun->firma_id && $user->yetkiler->urun === true  );
    }
}
