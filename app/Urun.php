<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    protected $table = 'urunler';

    protected $fillable = [
        'ad',
        'aciklama',
        'durum',
        'firma_id',
        'kategori_id',
        'birim_id',
    ];

    protected $casts = [
        'ad' => 'string',
        'aciklama' => 'text',
        'firma_id' => 'integer',
        'kategori_id' => 'integer',
        'birim_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function urunKategorisi(){
        return $this->belongsTo(UrunKategori::class,'kategori_id','id');
    }

    public function urunBirimi(){
        return $this->belongsTo(UrunBirim::class,'birim_id','id');
    }


}
