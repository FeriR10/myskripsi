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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->after('password')->nullable();
            $table->foreign('role_id')->references('id')->on('role');
            $table->unsignedBigInteger('supplier_id')->after('password')->nullable();
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->unsignedBigInteger('dealer_id')->after('password')->nullable();
            $table->foreign('dealer_id')->references('id')->on('dealer');
            $table->unsignedBigInteger('biller_id')->after('password')->nullable();
            $table->foreign('biller_id')->references('id')->on('biller');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
            $table->dropForeign('users_supplier_id_foreign');
            $table->dropColumn('supplier_id');
            $table->dropForeign('users_dealer_id_foreign');
            $table->dropColumn('dealer_id');
            $table->dropForeign('users_biller_id_foreign');
            $table->dropColumn('biller_id');
        });
    }
};
