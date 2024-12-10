<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('lkupcounty', function (Blueprint $table) {
            $table->foreign(['stateId'], 'fk_stateprovince')->references(['stateId'])->on('lkupstateprovince')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('lkupcounty', function (Blueprint $table) {
            $table->dropForeign('fk_stateprovince');
        });
    }
};
