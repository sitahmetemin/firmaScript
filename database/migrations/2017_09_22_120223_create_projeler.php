<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjeler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projeler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad');
            $table->integer('musteri_id')->unsigned()->nulleble();
            $table->integer('firma_id')->unsigned()->nulleble();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('musteri_id')
                ->references('id')
                ->on('musteriler');

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
        Schema::dropIfExists('projeler');
    }
}
