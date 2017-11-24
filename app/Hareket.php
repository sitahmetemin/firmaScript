<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hareket extends Model
{
    use SoftDeletes;

    protected $table = 'hareketler';

    protected $fillable = [
        'referans_tipi',
        'referans_id',
        'urun_id',
        'urun_birim_id',
        'urun_miktar',
        'hareket_yonu',
        'birim_id',
        'fatura_no',
        'irsaliye_no',
    ];

    protected $casts = [
        'referans_tipi' => 'string',
        'referans_id' => 'integer',
        'urun_id' => 'integer',
        'urun_birim_id' => 'integer',
        'urun_miktar' => 'integer',
        'hareket_yonu' => 'boolean',
        'birim_id' => 'integer',
        'fatura_no' => 'string',
        'irsaliye_no' => 'string',
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new FirmaScope());
        static::observe(FirmaObserver::class);
    }

    public function urun(){
        return $this->belongsTo(Urun::class,'urun_id','id');
    }

    public function birim(){
        return $this->belongsTo(Birim::class,'birim_id','id');
    }

    public function referans(){
        return $this->hasOne(Birim::class,'id','referans_id');
    }
}
