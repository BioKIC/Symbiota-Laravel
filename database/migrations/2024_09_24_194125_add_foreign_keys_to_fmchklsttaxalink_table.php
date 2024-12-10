<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmchklsttaxalink', function (Blueprint $table) {
            $table->foreign(['clid'], 'FK_chklsttaxalink_cid')->references(['clid'])->on('fmchecklists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_chklsttaxalink_tid')->references(['TID'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmchklsttaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_chklsttaxalink_cid');
            $table->dropForeign('FK_chklsttaxalink_tid');
        });
    }
};
