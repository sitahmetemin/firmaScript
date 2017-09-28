<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalepDetay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talep_detaylari', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urun_adet')->nullable();
            $table->integer('urun_id')->unsigned()->nullable();
            $table->integer('talep_id')->unsigned()->nullable();
            $table->integer('urun_birim_id')->unsigned()->nullable();
            $table->integer('firma_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('talep_id')
                ->references('id')
                ->on('talepler');

            $table->foreign('urun_id')
                ->references('id')
                ->on('urunler');

            $table->foreign('urun_birim_id')
                ->references('id')
                ->on('urun_birimleri');

            $table->foreign('firma_id')
                ->references('id')
                ->on('firmalar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talep_detaylari');
    }
}
