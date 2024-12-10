<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('lkupmunicipality', function (Blueprint $table) {
            $table->foreign(['stateId'], 'lkupmunicipality_ibfk_1')->references(['stateId'])->on('lkupstateprovince')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('lkupmunicipality', function (Blueprint $table) {
            $table->dropForeign('lkupmunicipality_ibfk_1');
        });
    }
};
