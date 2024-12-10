<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('specprocessorrawlabels', function (Blueprint $table) {
            $table->foreign(['imgid'], 'FK_specproc_images')->references(['imgid'])->on('images')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['occid'], 'FK_specproc_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('specprocessorrawlabels', function (Blueprint $table) {
            $table->dropForeign('FK_specproc_images');
            $table->dropForeign('FK_specproc_occid');
        });
    }
};
