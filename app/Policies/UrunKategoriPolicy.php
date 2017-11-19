<?php

namespace App\Policies;

use App\UrunKategori;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UrunKategoriPolicy
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
        return ($user->yetki == 'admin' ||  $user->yetkiler->urunKategorisi === true  );
    }

    public function create(User $user)
    {
        return ($user->yetki == 'admin' ||  $user->yetkiler->urunKategorisi === true  );
    }

    public function update(User $user, UrunKategori $urunKategori)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $urunKategori->firma_id && $user->yetkiler->urunKategorisi === true  );
    }

    public function delete(User $user, UrunKategori $urunKategori)
    {
        return ($user->yetki == 'admin' ||  $user->firma_id === $urunKategori->firma_id && $user->yetkiler->urunKategorisi === true  );
    }
}
