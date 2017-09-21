<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrunler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urunler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad');
            $table->text('aciklama')->nullable();
            $table->boolean('durum');
            $table->float('fiyat')->nullable();
            $table->float('iskonto')->nullable();
            $table->integer('birim_id')->unsigned()->nullable();
            $table->integer('kategori_id')->unsigned()->nullable();
            $table->integer('firma_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('birim_id')
                ->references('id')
                ->on('urun_birimleri')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('id')
                ->on('urun_kategorileri')
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
        Schema::dropIfExists('urunler');
    }
}
