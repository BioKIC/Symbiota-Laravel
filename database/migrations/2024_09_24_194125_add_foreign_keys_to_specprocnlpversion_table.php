<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprocnlpversion', function (Blueprint $table) {
            $table->foreign(['prlid'], 'FK_specprocnlpver_rawtext')->references(['prlid'])->on('specprocessorrawlabels')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprocnlpversion', function (Blueprint $table) {
            $table->dropForeign('FK_specprocnlpver_rawtext');
        });
    }
};
