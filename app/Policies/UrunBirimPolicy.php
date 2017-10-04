<?php

namespace App\Policies;

use App\UrunBirim;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UrunBirimPolicy
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
        return ( $user->yetkiler->urunBirimi === true  );
    }

    public function create(User $user)
    {
        return ( $user->yetkiler->urunBirimi === true  );
    }

    public function update(User $user, UrunBirim $urunBirim)
    {
        return ($user->firma_id === $urunBirim->firma_id && $user->yetkiler->urunBirimi === true  );
    }

    public function delete(User $user, UrunBirim $urunBirim)
    {
        return ($user->firma_id === $urunBirim->firma_id && $user->yetkiler->urunBirimi === true  );
    }
}
