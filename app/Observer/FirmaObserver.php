<?php

namespace App\Observers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FirmaObserver
{

    public function creating(Model $model)
    {
        $model->firma_id = (Auth::user()->yetki == 'superAdmin' ? session()->get('firma_id') : Auth::user()->firma_id);
    }

}