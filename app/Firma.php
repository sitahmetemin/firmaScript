<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firmalar';

    protected $fillable = [
        'ad',
        'durum'
    ];

    protected $casts = [
        'ad' => 'string',
        'durum' => 'boolean',
    ];
}
