<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurduplicatelink', function (Blueprint $table) {
            $table->foreign(['duplicateid'], 'FK_omoccurdupelink_dupeid')->references(['duplicateid'])->on('omoccurduplicates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occid'], 'FK_omoccurdupelink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurduplicatelink', function (Blueprint $table) {
            $table->dropForeign('FK_omoccurdupelink_dupeid');
            $table->dropForeign('FK_omoccurdupelink_occid');
        });
    }
};
