<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmchklstprojlink', function (Blueprint $table) {
            $table->foreign(['clid'], 'FK_chklstprojlink_clid')->references(['clid'])->on('fmchecklists')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['pid'], 'FK_chklstprojlink_proj')->references(['pid'])->on('fmprojects')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmchklstprojlink', function (Blueprint $table) {
            $table->dropForeign('FK_chklstprojlink_clid');
            $table->dropForeign('FK_chklstprojlink_proj');
        });
    }
};
