<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurassociations', function (Blueprint $table) {
            $table->increments('associd');
            $table->unsignedInteger('occid')->index('ix_ossococcur_occid');
            $table->string('associationType', 45);
            $table->unsignedInteger('occidAssociate')->nullable()->index('ix_ossococcur_occidassoc');
            $table->string('relationship', 150)->comment('dwc:relationshipOfResource');
            $table->string('relationshipID', 45)->nullable()->comment('dwc:relationshipOfResourceID (e.g. ontology link)');
            $table->string('subType', 45)->nullable();
            $table->string('objectID', 250)->nullable()->comment('dwc:relatedResourceID (object identifier)');
            $table->string('identifier', 250)->nullable()->index('ix_occurassoc_identifier')->comment('Deprecated field');
            $table->string('basisOfRecord', 45)->nullable();
            $table->string('resourceUrl', 250)->nullable()->comment('link to resource');
            $table->string('verbatimSciname', 250)->nullable()->index('ix_occurassoc_verbatimsciname');
            $table->unsignedInteger('tid')->nullable()->index('fk_occurassoc_tid_idx');
            $table->string('locationOnHost', 250)->nullable();
            $table->string('conditionOfAssociate', 250)->nullable();
            $table->dateTime('establishedDate')->nullable()->comment('dwc:relationshipEstablishedDate');
            $table->text('imageMapJSON')->nullable();
            $table->text('dynamicProperties')->nullable();
            $table->string('notes', 250)->nullable()->comment('dwc:relationshipRemarks');
            $table->string('accordingTo', 45)->nullable()->comment('dwc:relationshipAccordingTo (verbatim text)');
            $table->string('instanceID', 45)->nullable()->comment('dwc:resourceRelationshipID, if association was defined externally ');
            $table->string('sourceIdentifier', 45)->nullable()->comment('deprecated field');
            $table->string('recordID', 45)->nullable()->index('ix_occurassoc_recordid')->comment('dwc:resourceRelationshipID, if association was defined internally ');
            $table->unsignedInteger('createdUid')->nullable()->index('fk_occurassoc_uidcreated_idx');
            $table->dateTime('modifiedTimestamp')->nullable();
            $table->unsignedInteger('modifiedUid')->nullable()->index('fk_occurassoc_uidmodified_idx');
            $table->timestamp('initialtimestamp')->useCurrent();

            $table->unique(['occid', 'relationship', 'resourceUrl'], 'uq_omoccurassoc_external');
            $table->unique(['occid', 'identifier'], 'uq_omoccurassoc_identifier');
            $table->unique(['occid', 'occidAssociate', 'relationship'], 'uq_omoccurassoc_occid');
            $table->unique(['occid', 'verbatimSciname', 'associationType'], 'uq_omoccurassoc_sciname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurassociations');
    }
};
