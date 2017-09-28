<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birim', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad');
            $table->string('adres');
            $table->string('il');
            $table->integer('firma_id')->unsigned()->nullable();
            $table->integer('tur_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('firma_id')
                ->references('id')
                ->on('firmalar');

            $table->foreign('tur_id')
                ->references('id')
                ->on('birim_turu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('birim');
    }
}
