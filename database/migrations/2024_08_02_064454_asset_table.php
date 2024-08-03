<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hotel');
            $table->string('alamat');
            $table->string('phone');
            $table->string('email');
            $table->string('headline');
            $table->string('deskripsi',1000);
            $table->string('background_img');
            $table->string('welcome_img');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
