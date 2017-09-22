<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
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

    public function firma() {
        return $this->belongsTo(Firma::class, 'firma_id', 'id');
    }

    public function musteri() {
        return $this->belongsTo(Musteri::class, 'musteri_id', 'id');
    }
}
