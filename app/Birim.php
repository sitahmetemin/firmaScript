<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
    protected $table = 'birim';

    protected $fillable = [
        'ad',
        'adres',
        'il',
        'firma_id',
        'tur_id'
    ];

    protected $casts = [
        'ad' => 'string',
        'adres' => 'string',
        'il' => 'string',
        'firma_id' => 'integer',
        'tur_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function birimTuru(){
        return $this->belongsTo(BirimTuru::class,'tur_id','id');
    }


}
