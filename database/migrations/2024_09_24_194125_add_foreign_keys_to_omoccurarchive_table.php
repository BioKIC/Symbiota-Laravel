<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurarchive', function (Blueprint $table) {
            $table->foreign(['createdUid'], 'FK_occurarchive_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurarchive', function (Blueprint $table) {
            $table->dropForeign('FK_occurarchive_uid');
        });
    }
};
