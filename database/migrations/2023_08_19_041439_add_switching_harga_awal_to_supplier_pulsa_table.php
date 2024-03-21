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
        Schema::table('supplier_pulsa', function (Blueprint $table) {
            $table->integer('switching')->after('nominal');
            $table->integer('harga_awal')->after('nominal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_pulsa', function (Blueprint $table) {
            $table->dropColumn('switching');
            $table->dropColumn('harga_awal');
        });
    }
};
