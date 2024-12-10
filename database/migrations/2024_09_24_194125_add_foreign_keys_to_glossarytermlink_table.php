<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('glossarytermlink', function (Blueprint $table) {
            $table->foreign(['glossgrpid'], 'FK_glossarytermlink_glossgrpid')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['glossid'], 'FK_glossarytermlink_glossid')->references(['glossid'])->on('glossary')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('glossarytermlink', function (Blueprint $table) {
            $table->dropForeign('FK_glossarytermlink_glossgrpid');
            $table->dropForeign('FK_glossarytermlink_glossid');
        });
    }
};
