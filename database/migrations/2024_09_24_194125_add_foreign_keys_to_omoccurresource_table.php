<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('omoccurresource', function (Blueprint $table) {
            $table->foreign(['createdUid'], 'FK_omoccurresource_createdUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['modifiedUid'], 'FK_omoccurresource_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['occid'], 'FK_omoccurresource_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('omoccurresource', function (Blueprint $table) {
            $table->dropForeign('FK_omoccurresource_createdUid');
            $table->dropForeign('FK_omoccurresource_modUid');
            $table->dropForeign('FK_omoccurresource_occid');
        });
    }
};
