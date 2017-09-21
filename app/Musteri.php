<?php

namespace App;

use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;

class Musteri extends Model
{
    protected $table = 'musteriler';

    protected $fillable = [
        'unvan',
        'telefon',
        'email',
        'adres',
        'il',
        'yetkili_id',
        'firma_id',
    ];

    protected $casts = [
        'unvan' => 'string',
        'telefon' => 'string',
        'email' => 'string',
        'adres' => 'string',
        'il' => 'string',
        'yetkili_id' => 'integer',
        'firma_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
    }

    public function yetkili(){
        return $this->belongsTo(User::class,'yetkili_id','id');
    }
}
