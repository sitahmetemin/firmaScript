<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class UrunBirim extends Model
{
    protected $table = 'urun_birimleri';

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

    public function urun(){
        return $this->hasMany(Urun::class,'id','birim_id');
    }
}
