<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('usertaxonomy', function (Blueprint $table) {
            $table->foreign(['taxauthid'], 'FK_usertaxonomy_taxauthid')->references(['taxauthid'])->on('taxauthority')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['tid'], 'FK_usertaxonomy_tid')->references(['tid'])->on('taxa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'FK_usertaxonomy_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('usertaxonomy', function (Blueprint $table) {
            $table->dropForeign('FK_usertaxonomy_taxauthid');
            $table->dropForeign('FK_usertaxonomy_tid');
            $table->dropForeign('FK_usertaxonomy_uid');
        });
    }
};
