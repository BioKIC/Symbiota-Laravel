<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurarchive', function (Blueprint $table) {
            $table->increments('archiveID');
            $table->text('archiveObj');
            $table->unsignedInteger('occid')->nullable()->unique('uq_occurarchive_occid');
            $table->string('catalogNumber', 45)->nullable()->index('ix_occurarchive_catnum');
            $table->string('occurrenceID')->nullable()->index('ix_occurarchive_occurrenceid');
            $table->string('recordID', 45)->nullable()->index('ix_occurarchive_recordid');
            $table->string('archiveReason', 45)->nullable();
            $table->string('remarks', 150)->nullable();
            $table->unsignedInteger('createdUid')->nullable()->index('fk_occurarchive_uid_idx');
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurarchive');
    }
};
