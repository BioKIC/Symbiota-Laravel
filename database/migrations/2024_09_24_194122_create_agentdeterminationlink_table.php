<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentdeterminationlink', function (Blueprint $table) {
            $table->bigInteger('agentID');
            $table->unsignedInteger('detID')->index('fk_agentdetlink_detid_idx');
            $table->string('role', 45)->default('')->index('ix_agentdetlink_role');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_agentdetlink_created_idx');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_agentdetlink_modified_idx');
            $table->dateTime('dateLastModified')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['agentID', 'detID', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentdeterminationlink');
    }
};
