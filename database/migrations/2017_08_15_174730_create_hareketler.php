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
            $table->enum('referans_tipi', [
                'talep',
                'proje'
            ]);
            $table->integer('referans_id');
            $table->integer('urun_id')->unsigned()->nullable();
            $table->integer('urun_birim_id')->unsigned()->nullable();
            $table->integer('urun_miktar');
            $table->boolean('hareket_yonu');
            $table->integer('birim_id')->unsigned()->nullable();
            $table->integer('firma_id')->unsigned();
            $table->string('fatura_no')->nullable();
            $table->string('irsaliye_no')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('urun_id')
                ->references('id')
                ->on('urunler');

            $table->foreign('urun_birim_id')
                ->references('id')
                ->on('urun_birimleri');

            $table->foreign('birim_id')
                ->references('id')
                ->on('birim');

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
        Schema::dropIfExists('hareketler');
    }
}
