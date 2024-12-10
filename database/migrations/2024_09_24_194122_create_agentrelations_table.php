<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentrelations', function (Blueprint $table) {
            $table->bigInteger('agentRelationsID', true);
            $table->bigInteger('fromAgentID')->index('fk_agentrelations_fromagentid_idx');
            $table->bigInteger('toAgentID')->index('fk_agentrelations_toagentid_idx');
            $table->string('relationship', 50)->index('fk_agentrelations_relationship_idx');
            $table->string('notes', 900)->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_agentrelations_createuid_idx');
            $table->dateTime('dateLastModified')->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_agentrelations_moduid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentrelations');
    }
};
