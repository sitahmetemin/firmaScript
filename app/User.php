<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'firma_id',
        'tc_no',
        'birim_id',
        'yetki',

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function firma(){
        return $this->hasOne(Firma::class,'id','firma_id');
    }

    public function birim(){
        return $this->belongsTo(Birim::class,'birim_id','id');
    }

    public function yetkiler(){
        return $this->hasOne(Yetki::class,'user_id','id');
    }

    public function isSuperAdmin () {
        return $this->yetki === 'superAdmin';
    }


}
