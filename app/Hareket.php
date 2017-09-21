<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hareket extends Model
{
    protected $table = 'hareketler';

    protected $fillable = [
        'aciklama',
        'onay',
        'urun_id',
        'urun_adet',
        'urun_birim_id',
        'referans_id',
        'calisan_id',
    ];

    protected $casts = [
        'aciklama' => 'string',
        'onay' => 'boolean',
        'urun_id' => 'integer',
        'urun_adet' => 'integer',
        'urun_birim_id' => 'integer',
        'referans_id' => 'integer',
        'calisan_id' => 'integer',
    ];

    public function referans()
    {
        return $this->belongsTo(Referans::class, 'referans_id', 'id');
    }
}
