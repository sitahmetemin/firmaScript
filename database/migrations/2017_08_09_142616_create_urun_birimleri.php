<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrunBirimleri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urun_birimleri', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad');
            $table->integer('firma_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('urun_birimleri');
    }
}
