<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossarycategorylink', function (Blueprint $table) {
            $table->foreign(['glossCatID'], 'FK_glossCatLink_glossCatID')->references(['glossCatID'])->on('glossarycategory')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['glossID'], 'FK_glossCatLink_glossID')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossarycategorylink', function (Blueprint $table) {
            $table->dropForeign('FK_glossCatLink_glossCatID');
            $table->dropForeign('FK_glossCatLink_glossID');
        });
    }
};
