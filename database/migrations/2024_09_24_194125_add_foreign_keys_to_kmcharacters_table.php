<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcharacters', function (Blueprint $table) {
            $table->foreign(['hid'], 'FK_charheading')->references(['hid'])->on('kmcharheading')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['glossid'], 'FK_kmchar_glossary')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcharacters', function (Blueprint $table) {
            $table->dropForeign('FK_charheading');
            $table->dropForeign('FK_kmchar_glossary');
        });
    }
};
