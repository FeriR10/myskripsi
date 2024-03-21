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
        Schema::table('biller_pulsa', function (Blueprint $table) {
            $table->unsignedBigInteger('kartu_id')->after('pulsa_id');
            $table->foreign('kartu_id')->references('id')->on('kartu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biller_pulsa', function (Blueprint $table) {
            $table->dropForeign('biller_pulsa_kartu_id_foreign');
            $table->dropColumn('kartu_id');
        });
    }
};
