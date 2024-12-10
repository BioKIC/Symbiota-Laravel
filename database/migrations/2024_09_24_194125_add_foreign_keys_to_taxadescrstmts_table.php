<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxadescrstmts', function (Blueprint $table) {
            $table->foreign(['tdbid'], 'FK_taxadescrstmts_tblock')->references(['tdbid'])->on('taxadescrblock')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxadescrstmts', function (Blueprint $table) {
            $table->dropForeign('FK_taxadescrstmts_tblock');
        });
    }
};
