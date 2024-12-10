<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurdatasets', function (Blueprint $table) {
            $table->increments('datasetID');
            $table->string('datasetName', 150)->nullable();
            $table->string('bibliographicCitation', 500)->nullable();
            $table->string('name', 100);
            $table->string('category', 45)->nullable();
            $table->integer('isPublic')->nullable();
            $table->unsignedInteger('parentDatasetID')->nullable()->index('fk_omoccurdatasets_parent_idx');
            $table->integer('includeInSearch')->nullable();
            $table->text('description')->nullable();
            $table->string('datasetIdentifier', 150)->nullable();
            $table->string('notes', 250)->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->integer('sortSequence')->nullable();
            $table->unsignedInteger('uid')->nullable()->index('fk_omoccurdatasets_uid_idx');
            $table->unsignedInteger('collid')->nullable()->index('fk_omcollections_collid_idx');
            $table->timestamp('initialTimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurdatasets');
    }
};
