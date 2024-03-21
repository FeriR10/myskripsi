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
        Schema::table('biller_kartu_perdana', function (Blueprint $table) {
            $table->unsignedBigInteger('dealer_id')->after('id');
            $table->foreign('dealer_id')->references('id')->on('dealer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biller_kartu_perdana', function (Blueprint $table) {
            $table->dropForeign('biller_kartu_perdana_dealer_id_foreign');
            $table->dropColumn('dealer_id');
        });
    }
};
