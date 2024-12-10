<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('media_id');
            $table->unsignedInteger('tid')->nullable()->index('fk_media_taxa');
            $table->unsignedInteger('occid')->nullable()->index('fk_media_occid');
            $table->string('url', 250)->nullable();
            $table->string('thumbnailUrl')->nullable();
            $table->string('originalUrl')->nullable();
            $table->string('archiveUrl')->nullable();
            $table->string('sourceurl', 250)->nullable();
            $table->string('referenceUrl')->nullable();
            $table->string('caption', 250)->nullable();
            $table->unsignedInteger('creatoruid')->nullable()->index('fk_creator_uid');
            $table->string('creator', 45)->nullable();
            $table->string('media_type', 45)->nullable();
            $table->string('imageType', 50)->nullable();
            $table->string('format', 45)->nullable();
            $table->string('owner', 250)->nullable();
            $table->string('locality', 250)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('notes', 350)->nullable();
            $table->string('mediaMD5', 45)->nullable();
            $table->string('anatomy', 100)->nullable();
            $table->string('username', 45)->nullable();
            $table->string('sourceIdentifier', 150)->nullable();
            $table->string('hashFunction', 45)->nullable();
            $table->string('hashValue', 45)->nullable();
            $table->integer('pixelYDimension')->nullable();
            $table->integer('pixelXDimension')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->integer('defaultDisplay')->nullable();
            $table->string('recordID', 45)->nullable();
            $table->string('copyright')->nullable();
            $table->string('rights')->nullable();
            $table->string('accessRights')->nullable();
            $table->integer('sortsequence')->nullable();
            $table->integer('sortOccurrence')->nullable()->default(5);
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('media');
    }
};
