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
        Schema::create('biller_pulsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('biller_id');
            $table->foreign('biller_id')->references('id')->on('biller');
            $table->unsignedBigInteger('dealer_pulsa_id');
            $table->foreign('dealer_pulsa_id')->references('id')->on('dealer_pulsa');
            $table->unsignedBigInteger('pulsa_id');
            $table->foreign('pulsa_id')->references('id')->on('pulsa');
            $table->integer('nominal');
            $table->integer('switching');
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
        Schema::dropIfExists('biller_pulsa');
    }
};
