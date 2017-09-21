<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirimTuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birim_turu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad');
            $table->integer('firma_id')->unsigned()->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('birim_turu');
    }
}
