<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurpaleo', function (Blueprint $table) {
            $table->comment('Occurrence Paleo tables');
            $table->increments('paleoID');
            $table->unsignedInteger('occid')->index('fk_paleo_occid_idx');
            $table->string('eon', 65)->nullable();
            $table->string('era', 65)->nullable();
            $table->string('period', 65)->nullable();
            $table->string('epoch', 65)->nullable();
            $table->string('earlyInterval', 65)->nullable();
            $table->string('lateInterval', 65)->nullable();
            $table->string('absoluteAge', 65)->nullable();
            $table->string('storageAge', 65)->nullable();
            $table->string('stage', 65)->nullable();
            $table->string('localStage', 65)->nullable();
            $table->string('biota', 65)->nullable()->comment('Flora or Fanua');
            $table->string('biostratigraphy', 65)->nullable()->comment('Biozone');
            $table->string('taxonEnvironment', 65)->nullable()->comment('Marine or not');
            $table->string('lithogroup', 65)->nullable();
            $table->string('formation', 65)->nullable();
            $table->string('member', 65)->nullable();
            $table->string('bed', 65)->nullable();
            $table->string('lithology', 250)->nullable();
            $table->string('stratRemarks', 250)->nullable();
            $table->string('element', 250)->nullable();
            $table->string('slideProperties', 1000)->nullable();
            $table->string('geologicalContextID', 45)->nullable();
            $table->timestamp('initialtimestamp')->nullable()->useCurrent();

            $table->unique(['occid'], 'unique_occid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurpaleo');
    }
};
