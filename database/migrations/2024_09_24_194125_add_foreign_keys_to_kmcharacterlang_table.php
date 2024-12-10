<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcharacterlang', function (Blueprint $table) {
            $table->foreign(['cid'], 'FK_characterlang_1')->references(['cid'])->on('kmcharacters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['langid'], 'FK_charlang_lang')->references(['langid'])->on('adminlanguages')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcharacterlang', function (Blueprint $table) {
            $table->dropForeign('FK_characterlang_1');
            $table->dropForeign('FK_charlang_lang');
        });
    }
};
