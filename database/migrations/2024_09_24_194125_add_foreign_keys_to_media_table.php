<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('media', function (Blueprint $table) {
            $table->foreign(['creatoruid'], 'FK_creator_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['occid'], 'FK_media_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['tid'], 'FK_media_taxa')->references(['tid'])->on('taxa')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('media', function (Blueprint $table) {
            $table->dropForeign('FK_creator_uid');
            $table->dropForeign('FK_media_occid');
            $table->dropForeign('FK_media_taxa');
        });
    }
};
