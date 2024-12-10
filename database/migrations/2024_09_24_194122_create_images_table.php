<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('imgid');
            $table->unsignedInteger('tid')->nullable()->index('index_tid');
            $table->string('url')->nullable();
            $table->string('thumbnailUrl')->nullable();
            $table->string('originalUrl')->nullable();
            $table->string('archiveUrl')->nullable();
            $table->string('photographer', 100)->nullable();
            $table->unsignedInteger('photographerUid')->nullable()->index('fk_photographeruid');
            $table->string('imageType', 50)->nullable();
            $table->string('format', 45)->nullable();
            $table->string('caption', 100)->nullable();
            $table->string('owner', 250)->nullable();
            $table->string('sourceUrl')->nullable();
            $table->string('referenceUrl')->nullable();
            $table->string('copyright')->nullable();
            $table->string('rights')->nullable();
            $table->string('accessRights')->nullable();
            $table->string('locality', 250)->nullable();
            $table->unsignedInteger('occid')->nullable()->index('fk_images_occ');
            $table->string('notes', 350)->nullable();
            $table->string('anatomy', 100)->nullable();
            $table->string('username', 45)->nullable();
            $table->string('sourceIdentifier', 150)->nullable();
            $table->string('hashFunction', 45)->nullable();
            $table->string('hashValue', 45)->nullable();
            $table->string('mediaMD5', 45)->nullable();
            $table->integer('pixelYDimension')->nullable();
            $table->integer('pixelXDimension')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->integer('defaultDisplay')->nullable();
            $table->string('recordID', 45)->nullable()->index('ix_images_recordid');
            $table->unsignedInteger('sortSequence')->default(50);
            $table->integer('sortOccurrence')->nullable()->default(5);
            $table->timestamp('initialTimestamp')->useCurrent()->index('index_images_datelastmod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('images');
    }
};
