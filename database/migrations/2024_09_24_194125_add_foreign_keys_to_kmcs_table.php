<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcs', function (Blueprint $table) {
            $table->foreign(['cid'], 'FK_cs_chars')->references(['cid'])->on('kmcharacters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['glossid'], 'FK_kmcs_glossid')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcs', function (Blueprint $table) {
            $table->dropForeign('FK_cs_chars');
            $table->dropForeign('FK_kmcs_glossid');
        });
    }
};
