<?php

namespace App\Policies;

use App\BirimTuru;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BirimTuruPolicy
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
        return ($user->yetkiler->birimTuru === true );
    }

    public function create(User $user)
    {
        return ($user->yetkiler->birimTuru === true );
    }

    public function update(User $user, BirimTuru $birimTuru)
    {
        return ($user->firma_id === $birimTuru->firma_id && $user->yetkiler->birimTuru === true );
    }

    public function delete(User $user, BirimTuru $birimTuru)
    {
        return ($user->firma_id === $birimTuru->firma_id && $user->yetkiler->birimTuru === true );
    }
}
