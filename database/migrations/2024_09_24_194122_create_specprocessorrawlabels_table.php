<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('specprocessorrawlabels', function (Blueprint $table) {
            $table->increments('prlid');
            $table->unsignedInteger('imgid')->nullable()->index('fk_specproc_images');
            $table->unsignedInteger('occid')->nullable()->index('fk_specproc_occid');
            $table->text('rawstr');
            $table->string('processingvariables', 250)->nullable();
            $table->integer('score')->nullable();
            $table->string('notes')->nullable();
            $table->string('source', 150)->nullable();
            $table->integer('sortsequence')->nullable();
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('specprocessorrawlabels');
    }
};
