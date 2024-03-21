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
        Schema::table('dealer_pulsa', function (Blueprint $table) {
            $table->unsignedBigInteger('kartu_id')->after('supplier_pulsa_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
            $table->unsignedBigInteger('pulsa_id')->after('supplier_pulsa_id');
            $table->foreign('pulsa_id')->references('id')->on('pulsa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealer_pulsa', function (Blueprint $table) {
            $table->dropForeign('supplier_pulsa_kartu_id_foreign');
            $table->dropColumn('kartu_id');
            $table->dropForeign('supplier_pulsa_pulsa_id_foreign');
            $table->dropColumn('pulsa_id');
        });
    }
};
