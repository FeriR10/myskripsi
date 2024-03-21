<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan_biller_pulsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biller_id');
            $table->foreign('biller_id')->references('id')->on('biller');
            $table->unsignedBigInteger('biller_pulsa_id');
            $table->foreign('biller_pulsa_id')->references('id')->on('biller_pulsa');
            $table->unsignedBigInteger('kartu_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
            $table->unsignedBigInteger('pulsa_id');
            $table->foreign('pulsa_id')->references('id')->on('pulsa');
            $table->integer('nominal');
            $table->string('no_konsumen');
            $table->integer('harga_beli');
            $table->integer('switching');
            $table->integer('harga_jual');
            $table->integer('jumlah_transaksi');
            $table->integer('total_harga_beli');
            $table->integer('total_harga_jual');
            $table->string('keuntungan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_biller_pulsa');
    }
};
