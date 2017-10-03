<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYetkiler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yetkiler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('birim');
            $table->boolean('birimTuru');
            $table->boolean('hareket');
            $table->boolean('musteri');
            $table->boolean('proje');
            $table->boolean('talep');
            $table->boolean('urun');
            $table->boolean('urunBirimi');
            $table->boolean('urunKategorisi');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yetkiler');
    }
}
