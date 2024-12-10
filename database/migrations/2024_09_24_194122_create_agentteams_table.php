<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentteams', function (Blueprint $table) {
            $table->bigInteger('agentTeamID', true);
            $table->bigInteger('teamAgentID')->index('fk_agentteams_teamagentid_idx');
            $table->bigInteger('memberAgentID')->index('fk_agentteams_memberagentid_idx');
            $table->integer('ordinal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentteams');
    }
};
