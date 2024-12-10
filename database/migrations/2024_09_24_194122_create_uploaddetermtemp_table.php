<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('uploaddetermtemp', function (Blueprint $table) {
            $table->unsignedInteger('occid')->nullable()->index('index_uploaddet_occid');
            $table->unsignedInteger('collid')->nullable()->index('index_uploaddet_collid');
            $table->string('dbpk', 150)->nullable()->index('index_uploaddet_dbpk');
            $table->string('identifiedBy')->default('');
            $table->string('dateIdentified', 45)->default('');
            $table->date('dateIdentifiedInterpreted')->nullable();
            $table->string('higherClassification', 150)->nullable();
            $table->string('sciname');
            $table->string('verbatimIdentification', 250)->nullable();
            $table->string('scientificNameAuthorship', 100)->nullable();
            $table->string('identificationQualifier', 45)->nullable();
            $table->string('family')->nullable();
            $table->string('genus', 45)->nullable();
            $table->string('specificEpithet', 45)->nullable();
            $table->string('verbatimTaxonRank', 45)->nullable();
            $table->string('taxonRank', 45)->nullable();
            $table->string('infraSpecificEpithet', 45)->nullable();
            $table->integer('iscurrent')->nullable()->default(0);
            $table->string('detType', 45)->nullable();
            $table->string('identificationReferences')->nullable();
            $table->string('identificationRemarks')->nullable();
            $table->string('taxonRemarks', 2000)->nullable();
            $table->string('identificationVerificationStatus', 45)->nullable();
            $table->string('taxonConceptID', 45)->nullable();
            $table->string('sourceIdentifier', 45)->nullable();
            $table->unsignedInteger('sortsequence')->nullable()->default(10);
            $table->timestamp('initialtimestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('uploaddetermtemp');
    }
};
