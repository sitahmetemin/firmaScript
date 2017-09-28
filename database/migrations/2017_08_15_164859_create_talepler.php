<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalepler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talepler', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('onay');
            $table->string('aciklama');
            $table->string('referans_tipi');
            $table->integer('birim_id')->unsigned();
            $table->integer('talep_eden_calisan_id')->unsigned();
            $table->integer('talep_eden_birim_id')->unsigned()->nullable();
            $table->integer('firma_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('birim_id')
                ->references('id')
                ->on('birim')
                ->onDelete('cascade');

            $table->foreign('talep_eden_calisan_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('talep_eden_birim_id')
                ->references('id')
                ->on('birim')
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
        Schema::dropIfExists('talepler');
    }
}
