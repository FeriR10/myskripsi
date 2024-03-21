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
        Schema::create('dealer_pulsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('supplier_pulsa_id');
            $table->foreign('supplier_pulsa_id')->references('id')->on('supplier_pulsa');
            $table->integer('nominal');
            $table->integer('harga_jual');
            $table->integer('jumlah_transaksi');
            $table->integer('total_saldo');
            $table->integer('harga_beli');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_pulsa');
    }
};
