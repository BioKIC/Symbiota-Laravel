<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmvouchers', function (Blueprint $table) {
            $table->foreign(['clTaxaID'], 'FK_fmvouchers_tidclid')->references(['clTaxaID'])->on('fmchklsttaxalink')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmvouchers', function (Blueprint $table) {
            $table->dropForeign('FK_fmvouchers_tidclid');
        });
    }
};
