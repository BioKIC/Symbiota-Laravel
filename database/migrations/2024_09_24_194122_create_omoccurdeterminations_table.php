<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurdeterminations', function (Blueprint $table) {
            $table->increments('detid');
            $table->unsignedInteger('occid');
            $table->string('identifiedBy')->default('');
            $table->bigInteger('identifiedByAgentID')->nullable()->index('fk_omoccurdets_agentid_idx');
            $table->string('identifiedByID', 45)->nullable();
            $table->string('dateIdentified', 45)->default('');
            $table->date('dateIdentifiedInterpreted')->nullable()->index('ix_omoccurdets_dateidinterpreted');
            $table->string('higherClassification', 150)->nullable();
            $table->string('family')->nullable()->index('ix_omoccurdets_family');
            $table->string('sciname')->index('ix_omoccurdets_sciname');
            $table->string('verbatimIdentification', 250)->nullable();
            $table->string('scientificNameAuthorship')->nullable();
            $table->unsignedInteger('tidInterpreted')->nullable()->index('fk_omoccurdets_tid');
            $table->string('identificationQualifier')->nullable();
            $table->string('genus', 45)->nullable();
            $table->string('specificEpithet', 45)->nullable();
            $table->string('verbatimTaxonRank', 45)->nullable();
            $table->string('taxonRank', 45)->nullable();
            $table->string('infraSpecificEpithet', 45)->nullable();
            $table->integer('isCurrent')->nullable()->default(0)->index('ix_omoccurdets_iscurrent');
            $table->integer('printQueue')->nullable()->default(0);
            $table->integer('appliedStatus')->nullable()->default(1);
            $table->integer('securityStatus')->default(0);
            $table->string('securityStatusReason', 100)->nullable();
            $table->string('detType', 45)->nullable();
            $table->string('identificationReferences', 2000)->nullable();
            $table->string('identificationRemarks', 2000)->nullable();
            $table->string('taxonRemarks', 2000)->nullable();
            $table->string('identificationVerificationStatus', 45)->nullable();
            $table->string('taxonConceptID', 45)->nullable();
            $table->string('sourceIdentifier', 45)->nullable();
            $table->unsignedInteger('sortSequence')->nullable()->default(10);
            $table->string('recordID', 45)->nullable()->index('ix_omoccurdets_recordid');
            $table->unsignedInteger('enteredByUid')->nullable()->index('fk_omoccurdets_uid_idx');
            $table->timestamp('dateLastModified')->nullable()->index('fk_omoccurdets_datemodified');
            $table->timestamp('initialTimestamp')->useCurrent()->index('fk_omoccurdets_initialtimestamp');

            $table->unique(['occid', 'dateIdentified', 'identifiedBy', 'sciname'], 'uq_omoccurdets_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurdeterminations');
    }
};
