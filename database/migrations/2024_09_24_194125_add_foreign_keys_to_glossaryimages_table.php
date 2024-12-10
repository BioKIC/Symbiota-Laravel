<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossaryimages', function (Blueprint $table) {
            $table->foreign(['glossid'], 'FK_glossaryimages_glossid')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'FK_glossaryimages_uid')->references(['uid'])->on('users')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossaryimages', function (Blueprint $table) {
            $table->dropForeign('FK_glossaryimages_glossid');
            $table->dropForeign('FK_glossaryimages_uid');
        });
    }
};
