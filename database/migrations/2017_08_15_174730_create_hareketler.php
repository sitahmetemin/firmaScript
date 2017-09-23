<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHareketler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hareketler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referans_tipi');
            $table->integer('referans_id')->unsigned()->nullable();
            $table->integer('urun_id')->unsigned()->nullable();
            $table->integer('urun_birim_id')->unsigned()->nullable();
            $table->integer('urun_miktar');
            $table->boolean('hareket_yonu');
            $table->integer('birim_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('referans_id')
                ->references('id')
                ->on('urunler')
                ->onDelete('cascade');

            $table->foreign('urun_id')
                ->references('id')
                ->on('urunler')
                ->onDelete('cascade');

            $table->foreign('urun_birim_id')
                ->references('id')
                ->on('urun_birimleri')
                ->onDelete('cascade');

            $table->foreign('birim_id')
                ->references('id')
                ->on('birimler')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hareketler');
    }
}
