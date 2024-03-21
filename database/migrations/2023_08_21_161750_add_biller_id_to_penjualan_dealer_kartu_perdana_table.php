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
        Schema::table('penjualan_dealer_kartu_perdana', function (Blueprint $table) {
            $table->unsignedBigInteger('biller_id')->after('id');
            $table->foreign('biller_id')->references('id')->on('biller');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan_dealer_kartu_perdana', function (Blueprint $table) {
            $table->dropForeign('penjualan_dealer_kartu_perdana_biller_id_foreign');
            $table->dropColumn('biller_id');
        });
    }
};
