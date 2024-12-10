<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentdeterminationlink', function (Blueprint $table) {
            $table->foreign(['agentID'], 'FK_agentdetlink_agentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['createdUid'], 'FK_agentdetlink_created')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['detID'], 'FK_agentdetlink_detid')->references(['detid'])->on('omoccurdeterminations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['modifiedUid'], 'FK_agentdetlink_modified')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentdeterminationlink', function (Blueprint $table) {
            $table->dropForeign('FK_agentdetlink_agentID');
            $table->dropForeign('FK_agentdetlink_created');
            $table->dropForeign('FK_agentdetlink_detid');
            $table->dropForeign('FK_agentdetlink_modified');
        });
    }
};
