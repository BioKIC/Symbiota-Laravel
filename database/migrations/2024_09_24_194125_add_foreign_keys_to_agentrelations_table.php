<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentrelations', function (Blueprint $table) {
            $table->foreign(['createdUid'], 'FK_agentrelations_createUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['fromAgentID'], 'FK_agentrelations_ibfk_1')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['toAgentID'], 'FK_agentrelations_ibfk_2')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['relationship'], 'FK_agentrelations_ibfk_3')->references(['relationship'])->on('ctrelationshiptypes')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['modifiedUid'], 'FK_agentrelations_modUid')->references(['uid'])->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentrelations', function (Blueprint $table) {
            $table->dropForeign('FK_agentrelations_createUid');
            $table->dropForeign('FK_agentrelations_ibfk_1');
            $table->dropForeign('FK_agentrelations_ibfk_2');
            $table->dropForeign('FK_agentrelations_ibfk_3');
            $table->dropForeign('FK_agentrelations_modUid');
        });
    }
};
