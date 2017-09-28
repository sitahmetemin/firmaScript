<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class UrunKategori extends Model
{
    protected $table = 'urun_kategorileri';

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

    public function urunler(){
        return $this->hasMany(UrunKategori::class,'id','kategori_id');
    }
}
