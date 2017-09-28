<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Yetki extends Model
{
    protected $table = 'yetkiler';

    protected $fillable = [
        'yetki',
    ];

    protected $casts = [
        'yetki' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }
}
