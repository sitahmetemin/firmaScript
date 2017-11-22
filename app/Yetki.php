<?php

namespace App;

use App\Observers\FirmaObserver;
use App\Scopes\FirmaScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yetki extends Model
{
    use SoftDeletes;

    protected $table = 'yetkiler';

    protected $fillable = [
        'birim',
        'birimTuru',
        'hareket',
        'musteri',
        'proje',
        'talep',
        'urun',
        'urunBirimi',
        'urunKategorisi',
        'user_id'
    ];

    protected $casts = [
        'birim' => 'boolean',
        'birimTuru' => 'boolean',
        'hareket' => 'boolean',
        'musteri' => 'boolean',
        'proje' => 'boolean',
        'talep' => 'boolean',
        'urun' => 'boolean',
        'urunBirimi' => 'boolean',
        'urunKategorisi' => 'boolean',
        'user_id' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    public function calisan () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setBirimAttribute($value) {
        $this->attributes['birim'] = $value == 'on' ? true : false;
    }

    public function setBirimTuruAttribute($value) {
        $this->attributes['birimTuru'] = $value == 'on' ? true : false;
    }

    public function setHareketAttribute($value) {
        $this->attributes['hareket'] = $value == 'on' ? true : false;
    }

    public function setMusteriAttribute($value) {
        $this->attributes['musteri'] = $value == 'on' ? true : false;
    }

    public function setProjeAttribute($value) {
        $this->attributes['proje'] = $value == 'on' ? true : false;
    }

    public function setTalepAttribute($value) {
        $this->attributes['talep'] = $value == 'on' ? true : false;
    }

    public function setUrunAttribute($value) {
        $this->attributes['urun'] = $value == 'on' ? true : false;
    }

    public function setUrunBirimiAttribute($value) {
        $this->attributes['urunBirimi'] = $value == 'on' ? true : false;
    }

    public function setUrunKategorisiAttribute($value) {
        $this->attributes['urunKategorisi'] = $value == 'on' ? true : false;
    }
}
