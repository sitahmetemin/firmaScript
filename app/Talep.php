<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Talep extends Model
{
    protected $table = 'talepler';

    protected $fillable = [
        'onay',
        'aciklama',
        'referans_tipi',
        'birim_id',
        'talep_eden_calisan_id',
        'talep_eden_birim_id',
        'firma_id'

    ];

    protected $casts = [
        'onay' => 'integer',
        'aciklama' => 'string',
        'referans_tipi' => 'string',
        'birim_id' => 'integer',
        'talep_eden_calisan_id' => 'integer',
        'talep_eden_birim_id' => 'integer',
        'firma_id' => 'integer',

    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function talepDetaylari()
    {
        return $this->hasMany(TalepDetay::class, 'talep_id', 'id');
    }

    public function calisan()
    {
        return $this->belongsTo(User::class, 'talep_eden_calisan_id', 'id');
    }

    public function birim()
    {
        return $this->belongsTo(Birim::class, 'birim_id', 'id');
    }

    public function calisanBirim()
    {
        return $this->belongsTo(Birim::class, 'talep_eden_birim_id', 'id');
    }

    public function firma()
    {
        return $this->belongsTo(Firma::class, 'firma_id', 'id');
    }
}
