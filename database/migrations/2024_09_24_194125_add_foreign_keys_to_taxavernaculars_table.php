<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxavernaculars', function (Blueprint $table) {
            $table->foreign(['TID'], 'FK_vernaculars_tid')->references(['tid'])->on('taxa')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['langid'], 'FK_vern_lang')->references(['langid'])->on('adminlanguages')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxavernaculars', function (Blueprint $table) {
            $table->dropForeign('FK_vernaculars_tid');
            $table->dropForeign('FK_vern_lang');
        });
    }
};
