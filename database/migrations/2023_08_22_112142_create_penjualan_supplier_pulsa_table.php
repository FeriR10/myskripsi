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
        Schema::create('penjualan_supplier_pulsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->unsignedBigInteger('pembelian_dp_id');
            $table->foreign('pembelian_dp_id')->references('id')->on('pembelian_dealer_pulsa');
            $table->unsignedBigInteger('kartu_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
            $table->unsignedBigInteger('pulsa_id');
            $table->foreign('pulsa_id')->references('id')->on('pulsa');
            $table->integer('nominal');
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
        Schema::dropIfExists('penjualan_supplier_pulsa');
    }
};
