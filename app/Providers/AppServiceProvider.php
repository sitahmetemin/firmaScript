<?php

namespace App\Providers;

use App\Birim;
use App\BirimTuru;
use App\Firma;
use App\Hareket;
use App\Musteri;
use App\Policies\PostBirim;
use App\Policies\PostBirimTuru;
use App\Policies\PostFirma;
use App\Policies\PostHareket;
use App\Policies\PostMusteri;
use App\Policies\PostProje;
use App\Policies\PostTalep;
use App\Policies\PostUrun;
use App\Policies\PostUrunBirim;
use App\Policies\PostUrunKategori;
use App\Policies\PostUser;
use App\Proje;
use App\Talep;
use App\Urun;
use App\UrunBirim;
use App\UrunKategori;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



}
