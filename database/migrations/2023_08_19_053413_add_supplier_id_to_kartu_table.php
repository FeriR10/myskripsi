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
        Schema::table('kartu', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->after('nama');
            $table->foreign('supplier_id')->references('id')->on('supplier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kartu', function (Blueprint $table) {
            $table->dropForeign('kartu_supplier_id_foreign');
            $table->dropColumn('supplier_id');
        });
    }
};
