<?php

namespace App;

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


}
