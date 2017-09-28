<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Hareket extends Model
{
    protected $table = 'hareketler';

    protected $fillable = [
        'referans_tipi',
        'referans_id',
        'urun_id',
        'urun_birim_id',
        'urun_miktar',
        'hareket_yonu',
        'birim_id',
    ];

    protected $casts = [
        'referans_tipi' => 'integer',
        'referans_id' => 'integer',
        'urun_id' => 'integer',
        'urun_birim_id' => 'integer',
        'urun_miktar' => 'integer',
        'hareket_yonu' => 'boolean',
        'birim_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function urun(){
        return $this->belongsTo(Urun::class,'urun_id','id');
    }

    public function birim(){
        return $this->belongsTo(Birim::class,'birim_id','id');
    }
}
