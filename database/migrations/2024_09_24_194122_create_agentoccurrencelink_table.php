<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentoccurrencelink', function (Blueprint $table) {
            $table->bigInteger('agentID');
            $table->unsignedInteger('occid')->index('fk_agentoccurlink_occid_idx');
            $table->string('role', 45)->default('')->index('fk_agentoccurlink_role');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_agentoccurlink_created_idx');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_agentoccurlink_modified_idx');
            $table->dateTime('dateLastModified')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();

            $table->primary(['agentID', 'occid', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentoccurrencelink');
    }
};
