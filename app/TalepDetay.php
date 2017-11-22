<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TalepDetay extends Model
{
    use SoftDeletes;

    protected $table = 'talep_detaylari';

    protected $fillable = [
        'talep_id',
        'urun_adet',
        'urun_id',
        'urun_birim_id',
        'firma_id',
    ];

    protected $casts = [
        'talep_id' => 'integer',
        'urun_adet' => 'integer',
        'urun_id' => 'integer',
        'urun_birim_id' => 'integer',
        'firma_id' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);

    }

    public function urun()
    {
        return $this->hasMany(Urun::class, 'id', 'urun_id');
    }

    public function talep()
    {
        return $this->belongsTo(Talep::class,'talep_id', 'id');
    }

    public function urunBirimi()
    {
        return $this->belongsTo(UrunBirim::class, 'urun_birim_id', 'id');
    }

    public function firma()
    {
        return $this->belongsTo(Firma::class, 'firma_id', 'id');
    }

}
