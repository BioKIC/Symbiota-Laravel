<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossarytaxalink', function (Blueprint $table) {
            $table->foreign(['glossid'], 'FK_glossarytaxa_glossid')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_glossarytaxa_tid')->references(['TID'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossarytaxalink', function (Blueprint $table) {
            $table->dropForeign('FK_glossarytaxa_glossid');
            $table->dropForeign('FK_glossarytaxa_tid');
        });
    }
};
