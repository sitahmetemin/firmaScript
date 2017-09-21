<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referans extends Model
{
    protected $table = 'referanslar';

    protected $fillable = [
        'tip'
    ];

    protected $casts = [
        'tip' => 'string',
    ];

    public function hareket(){
        return $this->hasMany(Hareket::class, 'id', 'referans_id');
    }
}
