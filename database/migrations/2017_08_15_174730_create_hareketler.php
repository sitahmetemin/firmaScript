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
            $table->string('aciklama');
            $table->boolean('onay');
            $table->string('referans_tipi');
            $table->integer('urun_adet');
            $table->integer('urun_id')->unsigned();
            $table->integer('urun_birim_id')->unsigned();
            $table->integer('calisan_id')->unsigned();
            $table->integer('talep_id')->unsigned();
            $table->integer('firma_id')->unsigned();
            $table->timestamps();

            $table->foreign('urun_id')
                ->references('id')
                ->on('urunler')
                ->onDelete('cascade');

            $table->foreign('urun_birim_id')
                ->references('id')
                ->on('urun_birimleri')
                ->onDelete('cascade');

            $table->foreign('talep_id')
                ->references('id')
                ->on('talepler')
                ->onDelete('cascade');

            $table->foreign('calisan_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('firma_id')
                ->references('id')
                ->on('firmalar')
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
