<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccuridentifiers', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_omoccuridentifiers_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccuridentifiers', function (Blueprint $table) {
            $table->dropForeign('FK_omoccuridentifiers_occid');
        });
    }
};
