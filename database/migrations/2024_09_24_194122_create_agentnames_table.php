<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('agentnames', function (Blueprint $table) {
            $table->bigInteger('agentNamesID')->primary();
            $table->bigInteger('agentID');
            $table->string('nameType', 32)->default('Full Name');
            $table->string('agentName')->index('ix_agentnames_name');
            $table->string('language', 6)->nullable()->default('en_us');
            $table->integer('createdUid')->nullable();
            $table->integer('modifiedUid')->nullable();
            $table->dateTime('dateLastModified')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['agentID', 'nameType', 'agentName'], 'uq_agentnames_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('agentnames');
    }
};
