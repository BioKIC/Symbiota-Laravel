<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('referenceoccurlink', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_refoccurlink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['refid'], 'FK_refoccurlink_refid')->references(['refid'])->on('referenceobject')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('referenceoccurlink', function (Blueprint $table) {
            $table->dropForeign('FK_refoccurlink_occid');
            $table->dropForeign('FK_refoccurlink_refid');
        });
    }
};
