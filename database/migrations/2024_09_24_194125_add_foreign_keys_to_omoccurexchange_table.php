<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurexchange', function (Blueprint $table) {
            $table->foreign(['collid'], 'FK_occexch_coll')->references(['collID'])->on('omcollections')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurexchange', function (Blueprint $table) {
            $table->dropForeign('FK_occexch_coll');
        });
    }
};
