<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firmalar';

    protected $fillable = [
        'ad',
        'telefon',
        'fax',
        'email',
        'vergi_no',
        'durum'
    ];

    protected $casts = [
        'ad' => 'string',
        'telefon' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'vergi_no' => 'string',
        'durum' => 'boolean',
    ];
}
