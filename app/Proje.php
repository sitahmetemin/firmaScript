<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proje extends Model
{
    use SoftDeletes;

    protected $table = 'projeler';

    protected $fillable = [
        'ad',
        'musteri_id',
        'firma_id'
    ];

    protected $casts = [
        'ad' => 'string',
        'musteri_id' => 'integer',
        'firma_id' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function firma() {
        return $this->belongsTo(Firma::class, 'firma_id', 'id');
    }

    public function musteri() {
        return $this->belongsTo(Musteri::class, 'musteri_id', 'id');
    }
}
