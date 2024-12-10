<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('unknowns', function (Blueprint $table) {
            $table->foreign(['tid'], 'FK_unknowns_tid')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['username'], 'FK_unknowns_username')->references(['username'])->on('userlogin')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('unknowns', function (Blueprint $table) {
            $table->dropForeign('FK_unknowns_tid');
            $table->dropForeign('FK_unknowns_username');
        });
    }
};
