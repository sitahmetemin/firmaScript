<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusteriler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musteriler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unvan');
            $table->string('telefon');
            $table->string('email');
            $table->string('adres');
            $table->string('il');
            $table->integer('yetkili_id')->unsigned();
            $table->integer('firma_id')->unsigned();
            $table->timestamps();

            $table->foreign('firma_id')
                ->references('id')
                ->on('firmalar')
                ->onDelete('cascade');

            $table->foreign('yetkili_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('musteriler');
    }
}
