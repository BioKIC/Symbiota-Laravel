<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('unknownimages', function (Blueprint $table) {
            $table->foreign(['unkid'], 'FK_unknowns')->references(['unkid'])->on('unknowns')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('unknownimages', function (Blueprint $table) {
            $table->dropForeign('FK_unknowns');
        });
    }
};
