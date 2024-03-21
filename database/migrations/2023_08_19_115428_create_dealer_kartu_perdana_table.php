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
        Schema::create('dealer_kartu_perdana', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('supplier_kartu_perdana_id');
            $table->foreign('supplier_kartu_perdana_id')->references('id')->on('supplier_kartu_perdana');
            $table->unsignedBigInteger('kartu_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
            $table->integer('harga_beli');
            $table->integer('switching');
            $table->integer('harga_jual');
            $table->integer('jumlah_transaksi');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_kartu_perdana');
    }
};
