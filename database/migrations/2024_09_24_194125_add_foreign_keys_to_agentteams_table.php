<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('agentteams', function (Blueprint $table) {
            $table->foreign(['memberAgentID'], 'FK_agentteams_memberAgentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['teamAgentID'], 'FK_agentteams_teamAgentID')->references(['agentID'])->on('agents')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('agentteams', function (Blueprint $table) {
            $table->dropForeign('FK_agentteams_memberAgentID');
            $table->dropForeign('FK_agentteams_teamAgentID');
        });
    }
};
