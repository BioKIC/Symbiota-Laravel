<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('kmcslang', function (Blueprint $table) {
            $table->foreign(['cid', 'cs'], 'FK_cslang_1')->references(['cid', 'cs'])->on('kmcs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['langid'], 'FK_cslang_lang')->references(['langid'])->on('adminlanguages')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('kmcslang', function (Blueprint $table) {
            $table->dropForeign('FK_cslang_1');
            $table->dropForeign('FK_cslang_lang');
        });
    }
};
