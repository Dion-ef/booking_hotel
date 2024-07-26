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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->unsignedBigInteger('kamar_id');
            $table->foreign('kamar_id')->references('id')->on('kamar')->onDelete('cascade');
            $table->string('kode')->unique()->nullable();
            $table->string('nama');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('in');
            $table->string('out');
            $table->string('jumlah_orang');
            $table->string('harga');
            $table->string('total');
            $table->date('tgl_pemesanan');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pemesanan');
    }
};
