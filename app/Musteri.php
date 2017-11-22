<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Musteri extends Model
{
    use SoftDeletes;

    protected $table = 'musteriler';

    protected $fillable = [
        'unvan',
        'telefon',
        'email',
        'adres',
        'il',
        'yetkili_id',
        'firma_id',
    ];

    protected $casts = [
        'unvan' => 'string',
        'telefon' => 'string',
        'email' => 'string',
        'adres' => 'string',
        'il' => 'string',
        'yetkili_id' => 'integer',
        'firma_id' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function yetkili(){
        return $this->belongsTo(User::class,'yetkili_id','id');
    }
}
