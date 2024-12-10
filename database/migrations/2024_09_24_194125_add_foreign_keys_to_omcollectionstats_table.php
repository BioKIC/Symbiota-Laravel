<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omcollectionstats', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_collectionstats_coll')->references(['collID'])->on('omcollections')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omcollectionstats', function (Blueprint $table) {
            $table->dropForeign('FK_collectionstats_coll');
        });
    }
};
