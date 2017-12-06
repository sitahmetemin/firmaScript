<?php

namespace App\Policies;

use App\Proje;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjePolicy
{
    use HandlesAuthorization;

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
        return ($user->yetki == 'admin' ||  $user->yetkiler->proje === true );
    }

    public function create(User $user)
    {
        return ($user->yetki == 'admin' ||  $user->yetkiler->proje === true  );
    }

    public function update(User $user, Proje $proje)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $proje->firma_id && $user->yetkiler->proje === true );
    }

    public function delete(User $user, Proje $proje)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $proje->firma_id && $user->yetkiler->proje === true );
    }
}
