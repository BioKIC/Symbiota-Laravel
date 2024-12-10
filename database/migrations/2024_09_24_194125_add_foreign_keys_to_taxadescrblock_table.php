<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxadescrblock', function (Blueprint $table) {
            $table->foreign(['tdProfileID'], 'FK_taxadescrblock_tdProfileID')->references(['tdProfileID'])->on('taxadescrprofile')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_taxadescrblock_tid')->references(['tid'])->on('taxa')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['langid'], 'FK_taxadesc_lang')->references(['langid'])->on('adminlanguages')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxadescrblock', function (Blueprint $table) {
            $table->dropForeign('FK_taxadescrblock_tdProfileID');
            $table->dropForeign('FK_taxadescrblock_tid');
            $table->dropForeign('FK_taxadesc_lang');
        });
    }
};
