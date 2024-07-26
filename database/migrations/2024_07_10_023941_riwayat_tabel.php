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
        Schema::create('riwayat_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->string('email');
            $table->string('phone');
            $table->string('nama_kamar');
            $table->string('jenis_kamar');
            $table->string('jumlah_orang');
            $table->date('tanggal_pemesanan');
            $table->string('tanggal_checkin');
            $table->string('tanggal_checkout');
            $table->string('total');
            $table->string('status');
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
        Schema::dropIfExists('riwayat_pemesanan');
    }
};
