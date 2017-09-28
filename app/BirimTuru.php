<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class BirimTuru extends Model
{
    protected $table = 'birim_turu';

    protected $fillable = [
        'ad',
        'firma_id',
    ];

    protected $casts = [
        'ad' => 'string',
        'firma_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function birim()
    {
        return $this->hasMany(Birim::class, 'tur_id', 'id');
    }

    public function calisan()
    {
        return $this->hasMany(User::class, 'id', 'id');
    }
}
