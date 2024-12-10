<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('fmchklstcoordinates', function (Blueprint $table) {
            $table->foreign(['clid'], 'FK_checklistCoord_clid')->references(['clid'])->on('fmchecklists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_checklistCoord_tid')->references(['tid'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('fmchklstcoordinates', function (Blueprint $table) {
            $table->dropForeign('FK_checklistCoord_clid');
            $table->dropForeign('FK_checklistCoord_tid');
        });
    }
};
