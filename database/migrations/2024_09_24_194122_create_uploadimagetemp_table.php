<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploadimagetemp', function (Blueprint $table) {
            $table->unsignedInteger('tid')->nullable();
            $table->string('url')->nullable();
            $table->string('thumbnailurl')->nullable();
            $table->string('originalurl')->nullable();
            $table->string('archiveurl')->nullable();
            $table->string('photographer', 100)->nullable();
            $table->unsignedInteger('photographeruid')->nullable();
            $table->string('imagetype', 50)->nullable();
            $table->string('format', 45)->nullable();
            $table->string('caption', 100)->nullable();
            $table->string('owner', 100)->nullable();
            $table->string('sourceUrl')->nullable();
            $table->string('referenceurl')->nullable();
            $table->string('copyright')->nullable();
            $table->string('accessrights')->nullable();
            $table->string('rights')->nullable();
            $table->string('locality', 250)->nullable();
            $table->unsignedInteger('occid')->nullable()->index('index_uploadimg_occid');
            $table->unsignedInteger('collid')->nullable()->index('index_uploadimg_collid');
            $table->string('dbpk', 150)->nullable()->index('index_uploadimg_dbpk');
            $table->string('sourceIdentifier', 150)->nullable();
            $table->string('notes')->nullable();
            $table->string('username', 45)->nullable();
            $table->unsignedInteger('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent()->index('index_uploadimg_ts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploadimagetemp');
    }
};
