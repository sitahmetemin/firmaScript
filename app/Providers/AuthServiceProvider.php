<?php

namespace App\Providers;

use App\Birim;
use App\BirimTuru;
use App\Firma;
use App\Hareket;
use App\Musteri;
use App\Policies\BirimPolicy;
use App\Policies\BirimTuruPolicy;
use App\Policies\FirmaPolicy;
use App\Policies\HareketPolicy;
use App\Policies\MusteriPolicy;
use App\Policies\ProjePolicy;
use App\Policies\TalepPolicy;
use App\Policies\UrunBirimPolicy;
use App\Policies\UrunKategoriPolicy;
use App\Policies\UrunPolicy;
use App\Policies\UserPolicy;
use App\Proje;
use App\Talep;
use App\Urun;
use App\UrunBirim;
use App\UrunKategori;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Firma::class => FirmaPolicy::class,
        Birim::class => BirimPolicy::class,
        BirimTuru::class => BirimTuruPolicy::class,
        Hareket::class => HareketPolicy::class,
        Musteri::class => MusteriPolicy::class,
        Proje::class => ProjePolicy::class,
        UrunBirim::class => UrunBirimPolicy::class,
        UrunKategori::class => UrunKategoriPolicy::class,
        Urun::class => UrunPolicy::class,
        User::class => UserPolicy::class,
        Talep::class => TalepPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }

}
