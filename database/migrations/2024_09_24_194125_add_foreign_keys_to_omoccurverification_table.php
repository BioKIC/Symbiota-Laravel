<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurverification', function (Blueprint $table) {
            $table->foreign(['occid'], 'FK_omoccurverification_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'FK_omoccurverification_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurverification', function (Blueprint $table) {
            $table->dropForeign('FK_omoccurverification_occid');
            $table->dropForeign('FK_omoccurverification_uid');
        });
    }
};
