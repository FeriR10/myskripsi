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
        Schema::create('penjualan_dealer_kartu_perdana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('pembelian_bkp_id');
            $table->foreign('pembelian_bkp_id')->references('id')->on('pembelian_biller_kartu_perdana');
            $table->unsignedBigInteger('kartu_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
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
        Schema::dropIfExists('penjualan_dealer_kartu_perdana');
    }
};
