<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firma extends Model
{
    use SoftDeletes;

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

    protected $dates = ['deleted_at'];
}
