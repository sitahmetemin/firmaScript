<?php

namespace App\Policies;

use App\Proje;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjePolicy
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
        return ( $user->yetkiler->proje === true );
    }

    public function create(User $user)
    {
        return ( $user->yetkiler->proje === true  );
    }

    public function update(User $user, Proje $proje)
    {
        return ($user->firma_id === $proje->firma_id && $user->yetkiler->proje === true );
    }

    public function delete(User $user, Proje $proje)
    {
        return ($user->firma_id === $proje->firma_id && $user->yetkiler->proje === true );
    }
}
