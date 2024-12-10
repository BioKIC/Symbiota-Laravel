<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurcomments', function (Blueprint $table) {
            $table->foreign(['occid'], 'fk_omoccurcomments_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['uid'], 'fk_omoccurcomments_uid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurcomments', function (Blueprint $table) {
            $table->dropForeign('fk_omoccurcomments_occid');
            $table->dropForeign('fk_omoccurcomments_uid');
        });
    }
};
