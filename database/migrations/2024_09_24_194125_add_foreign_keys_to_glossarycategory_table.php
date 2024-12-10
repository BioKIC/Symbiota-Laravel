<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossarycategory', function (Blueprint $table) {
            $table->foreign(['langID'], 'FK_glossarycategory_lang')->references(['langid'])->on('adminlanguages')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['parentCatID'], 'FK_glossarycategory_parentCatID')->references(['glossCatID'])->on('glossarycategory')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['translationCatID'], 'FK_glossarycategory_transCatID')->references(['glossCatID'])->on('glossarycategory')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossarycategory', function (Blueprint $table) {
            $table->dropForeign('FK_glossarycategory_lang');
            $table->dropForeign('FK_glossarycategory_parentCatID');
            $table->dropForeign('FK_glossarycategory_transCatID');
        });
    }
};
