<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('taxanestedtree', function (Blueprint $table) {
            $table->foreign(['tid'], 'FK_tnt_taxa')->references(['tid'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['taxauthid'], 'FK_tnt_taxauth')->references(['taxauthid'])->on('taxauthority')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('taxanestedtree', function (Blueprint $table) {
            $table->dropForeign('FK_tnt_taxa');
            $table->dropForeign('FK_tnt_taxauth');
        });
    }
};
