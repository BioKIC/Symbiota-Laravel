<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocessorprojects', function (Blueprint $table) {
            $table->increments('spprid');
            $table->unsignedInteger('collid')->index('fk_specprocessorprojects_coll');
            $table->string('title', 100);
            $table->string('projectType', 45)->nullable();
            $table->string('specKeyPattern', 45)->nullable();
            $table->string('patternReplace', 45)->nullable();
            $table->string('replaceStr', 45)->nullable();
            $table->string('specKeyRetrieval', 45)->nullable();
            $table->unsignedInteger('coordX1')->nullable();
            $table->unsignedInteger('coordX2')->nullable();
            $table->unsignedInteger('coordY1')->nullable();
            $table->unsignedInteger('coordY2')->nullable();
            $table->string('sourcePath', 250)->nullable();
            $table->string('targetPath', 250)->nullable();
            $table->string('imgUrl', 250)->nullable();
            $table->unsignedInteger('webPixWidth')->nullable()->default(1200);
            $table->unsignedInteger('tnPixWidth')->nullable()->default(130);
            $table->unsignedInteger('lgPixWidth')->nullable()->default(2400);
            $table->integer('jpgcompression')->nullable()->default(70);
            $table->unsignedInteger('createTnImg')->nullable()->default(1);
            $table->unsignedInteger('createLgImg')->nullable()->default(1);
            $table->text('additionalOptions')->nullable();
            $table->string('source', 45)->nullable();
            $table->integer('processingCode')->nullable();
            $table->date('lastRunDate')->nullable();
            $table->unsignedInteger('createdByUid')->nullable()->index('fk_specprocprojects_uid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocessorprojects');
    }
};
