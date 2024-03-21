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
        Schema::table('pembelian_dealer_kartu_perdana', function (Blueprint $table) {
            $table->unsignedBigInteger('dealer_kp_id')->after('id');
            $table->foreign('dealer_kp_id')->references('id')->on('dealer_kartu_perdana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian_dealer_kartu_perdana', function (Blueprint $table) {
            $table->dropForeign('pembelian_dealer_kartu_perdana_dealer_kp_id_foreign');
            $table->dropColumn('dealer_kp_id');
        });
    }
};
