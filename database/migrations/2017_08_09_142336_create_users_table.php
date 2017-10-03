<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('tc_no');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('yetki', [
                'superAdmin',
                'admin',
                'personel'
            ]);
            $table->integer('birim_id')->unsigned()->nullable();
            $table->integer('firma_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
