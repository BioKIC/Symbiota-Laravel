<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('portaloccurrences', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_portalOccur_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['pubid'], 'FK_portalOccur_pubid')->references(['pubid'])->on('portalpublications')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('portaloccurrences', function (Blueprint $table) {
            $table->dropForeign('FK_portalOccur_occid');
            $table->dropForeign('FK_portalOccur_pubid');
        });
    }
};
