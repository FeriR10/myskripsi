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
        Schema::create('pembelian_dealer_pulsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_pulsa_id');
            $table->foreign('dealer_pulsa_id')->references('id')->on('dealer_pulsa');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('supplier_pulsa_id');
            $table->foreign('supplier_pulsa_id')->references('id')->on('supplier_pulsa');
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
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_dealer_pulsa');
    }
};
