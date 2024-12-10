<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentlinks', function (Blueprint $table) {
            $table->bigInteger('agentLinksID', true);
            $table->bigInteger('agentID')->index('fk_agentlinks_agentid_idx');
            $table->string('type', 50)->nullable();
            $table->string('link', 900)->nullable();
            $table->boolean('isPrimaryTopicOf')->default(true);
            $table->string('text', 50)->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_agentlinks_createduid_idx');
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_agentlinks_moduid_idx');
            $table->dateTime('dateLastModified')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentlinks');
    }
};
