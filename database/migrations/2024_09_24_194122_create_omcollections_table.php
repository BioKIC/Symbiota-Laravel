<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omcollections', function (Blueprint $table) {
            $table->increments('collID');
            $table->string('institutionCode', 45);
            $table->string('collectionCode', 45)->nullable();
            $table->string('collectionName', 150);
            $table->string('collectionID', 100)->nullable();
            $table->string('datasetID', 250)->nullable();
            $table->string('datasetName', 100)->nullable();
            $table->unsignedInteger('iid')->nullable()->index('fk_collid_iid_idx');
            $table->string('fullDescription', 2000)->nullable();
            $table->string('homepage', 250)->nullable();
            $table->longText('resourceJson')->nullable();
            $table->string('individualUrl', 500)->nullable();
            $table->string('Contact', 250)->nullable();
            $table->string('email', 45)->nullable();
            $table->longText('contactJson')->nullable();
            $table->double('latitudeDecimal')->nullable();
            $table->double('longitudeDecimal')->nullable();
            $table->string('icon', 250)->nullable();
            $table->string('collType', 45)->default('Preserved Specimens')->comment('Preserved Specimens, General Observations, Observations');
            $table->string('managementType', 45)->nullable()->default('Snapshot')->comment('Snapshot, Live Data');
            $table->unsignedInteger('publicEdits')->default(1);
            $table->string('collectionGuid', 45)->nullable();
            $table->string('securityKey', 45)->nullable();
            $table->string('guidTarget', 45)->nullable();
            $table->string('rightsHolder', 250)->nullable();
            $table->string('rights', 250)->nullable();
            $table->string('usageTerm', 250)->nullable();
            $table->integer('publishToGbif')->nullable();
            $table->integer('publishToIdigbio')->nullable();
            $table->string('aggKeysStr', 1000)->nullable();
            $table->text('dwcTermJson')->nullable();
            $table->string('recordID', 45)->nullable();
            $table->string('dwcaUrl', 250)->nullable();
            $table->string('bibliographicCitation', 1000)->nullable();
            $table->string('accessRights', 1000)->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->unsignedInteger('sortSeq')->nullable();
            $table->timestamp('initialTimestamp')->useCurrent();

            $table->unique(['institutionCode', 'collectionCode'], 'index_inst');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omcollections');
    }
};
