<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentoccurrencelink', function (Blueprint $table) {
            $table->foreign(['agentID'], 'FK_agentoccurlink_agentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_agentoccurlink_created')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['modifiedUid'], 'FK_agentoccurlink_modified')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['occid'], 'FK_agentoccurlink_occid')->references(['occid'])->on('omoccurrences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentoccurrencelink', function (Blueprint $table) {
            $table->dropForeign('FK_agentoccurlink_agentID');
            $table->dropForeign('FK_agentoccurlink_created');
            $table->dropForeign('FK_agentoccurlink_modified');
            $table->dropForeign('FK_agentoccurlink_occid');
        });
    }
};
