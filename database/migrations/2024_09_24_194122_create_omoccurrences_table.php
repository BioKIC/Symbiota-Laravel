<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('omoccurrences', function (Blueprint $table) {
            $table->increments('occid');
            $table->unsignedInteger('collid');
            $table->string('dbpk', 150)->nullable();
            $table->string('basisOfRecord', 32)->nullable()->default('PreservedSpecimen')->comment('PreservedSpecimen, LivingSpecimen, HumanObservation');
            $table->string('occurrenceID')->nullable()->unique('index_gui')->comment('UniqueGlobalIdentifier');
            $table->string('catalogNumber', 32)->nullable()->index('index_catalognumber');
            $table->string('otherCatalogNumbers')->nullable()->index('index_othercatalognumbers');
            $table->string('ownerInstitutionCode', 32)->nullable()->index('index_ownerinst');
            $table->string('institutionID')->nullable();
            $table->string('collectionID')->nullable();
            $table->string('datasetID')->nullable();
            $table->string('organismID', 150)->nullable();
            $table->string('institutionCode', 64)->nullable();
            $table->string('collectionCode', 64)->nullable();
            $table->string('family')->nullable()->index('index_family');
            $table->string('scientificName')->nullable();
            $table->string('sciname')->nullable()->index('index_sciname');
            $table->unsignedInteger('tidInterpreted')->nullable()->index('fk_omoccurrences_tid');
            $table->string('genus')->nullable();
            $table->string('specificEpithet')->nullable();
            $table->string('taxonRank', 32)->nullable();
            $table->string('infraspecificEpithet')->nullable();
            $table->string('scientificNameAuthorship')->nullable();
            $table->text('taxonRemarks')->nullable();
            $table->string('identifiedBy')->nullable();
            $table->string('dateIdentified', 45)->nullable();
            $table->text('identificationReferences')->nullable();
            $table->text('identificationRemarks')->nullable();
            $table->string('identificationQualifier')->nullable()->comment('cf, aff, etc');
            $table->string('typeStatus')->nullable()->index('index_occurrences_typestatus');
            $table->string('recordedBy')->nullable()->index('index_collector')->comment('Collector(s)');
            $table->string('recordNumber', 45)->nullable()->index('index_collnum')->comment('Collector Number');
            $table->string('associatedCollectors')->nullable()->comment('not DwC');
            $table->date('eventDate')->nullable()->index('index_eventdate');
            $table->date('eventDate2')->nullable()->index('ix_omoccur_eventdate2');
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->integer('startDayOfYear')->nullable();
            $table->integer('endDayOfYear')->nullable();
            $table->string('verbatimEventDate')->nullable();
            $table->string('eventTime', 45)->nullable();
            $table->text('habitat')->nullable()->comment('Habitat, substrait, etc');
            $table->string('substrate', 500)->nullable();
            $table->text('fieldNotes')->nullable();
            $table->string('fieldNumber', 45)->nullable();
            $table->string('eventID', 150)->nullable()->index('index_eventid');
            $table->text('occurrenceRemarks')->nullable()->comment('General Notes');
            $table->string('informationWithheld', 250)->nullable();
            $table->string('dataGeneralizations', 250)->nullable();
            $table->text('associatedOccurrences')->nullable();
            $table->text('associatedTaxa')->nullable()->comment('Associated Species');
            $table->text('dynamicProperties')->nullable();
            $table->text('verbatimAttributes')->nullable();
            $table->string('behavior', 500)->nullable();
            $table->string('vitality', 150)->nullable();
            $table->string('reproductiveCondition')->nullable()->comment('Phenology: flowers, fruit, sterile');
            $table->integer('cultivationStatus')->nullable()->index('index_occurrences_cult')->comment('0 = wild, 1 = cultivated');
            $table->string('establishmentMeans', 150)->nullable();
            $table->string('lifeStage', 45)->nullable();
            $table->string('sex', 45)->nullable();
            $table->string('individualCount', 45)->nullable();
            $table->string('samplingProtocol', 100)->nullable();
            $table->string('samplingEffort', 200)->nullable();
            $table->string('preparations', 100)->nullable();
            $table->string('locationID', 150)->nullable()->index('index_locationid');
            $table->string('continent', 45)->nullable();
            $table->string('waterBody', 75)->nullable();
            $table->string('parentLocationID', 150)->nullable();
            $table->string('islandGroup', 75)->nullable();
            $table->string('island', 75)->nullable();
            $table->string('countryCode', 5)->nullable();
            $table->string('country', 64)->nullable()->index('index_country');
            $table->string('stateProvince')->nullable()->index('index_state');
            $table->string('county')->nullable()->index('index_county');
            $table->string('municipality')->nullable()->index('index_municipality');
            $table->text('locality')->nullable()->index('index_locality');
            $table->integer('localitySecurity')->nullable()->default(0)->index('index_occur_localitysecurity')->comment('0 = no security; 1 = hidden locality');
            $table->string('localitySecurityReason', 100)->nullable();
            $table->double('decimalLatitude')->nullable()->index('ix_occurrences_lat');
            $table->double('decimalLongitude')->nullable()->index('ix_occurrences_lng');
            $table->string('geodeticDatum')->nullable();
            $table->unsignedInteger('coordinateUncertaintyInMeters')->nullable();
            $table->text('footprintWKT')->nullable();
            $table->decimal('coordinatePrecision', 9, 7)->nullable();
            $table->text('locationRemarks')->nullable();
            $table->string('verbatimCoordinates')->nullable();
            $table->string('verbatimCoordinateSystem')->nullable();
            $table->string('georeferencedBy')->nullable();
            $table->dateTime('georeferencedDate')->nullable();
            $table->string('georeferenceProtocol')->nullable();
            $table->string('georeferenceSources')->nullable();
            $table->string('georeferenceVerificationStatus', 32)->nullable();
            $table->string('georeferenceRemarks', 500)->nullable();
            $table->integer('minimumElevationInMeters')->nullable()->index('occelevmin');
            $table->integer('maximumElevationInMeters')->nullable()->index('occelevmax');
            $table->string('verbatimElevation')->nullable();
            $table->integer('minimumDepthInMeters')->nullable();
            $table->integer('maximumDepthInMeters')->nullable();
            $table->string('verbatimDepth', 50)->nullable();
            $table->text('previousIdentifications')->nullable();
            $table->integer('availability')->nullable();
            $table->string('disposition', 250)->nullable();
            $table->string('storageLocation', 100)->nullable();
            $table->string('genericColumn1', 100)->nullable();
            $table->string('genericColumn2', 100)->nullable();
            $table->dateTime('modified')->nullable()->comment('DateLastModified');
            $table->string('language', 20)->nullable();
            $table->unsignedInteger('observerUid')->nullable()->index('fk_omoccurrences_uid');
            $table->string('processingStatus', 45)->nullable()->index('index_occurrences_procstatus');
            $table->string('recordEnteredBy', 250)->nullable()->index('index_occurrecordenteredby');
            $table->unsignedInteger('duplicateQuantity')->nullable();
            $table->string('labelProject', 250)->nullable();
            $table->text('dynamicFields')->nullable();
            $table->string('recordID', 45)->nullable()->index('ix_omoccurrences_recordid');
            $table->dateTime('dateEntered')->nullable()->index('index_occurdateentered');
            $table->timestamp('dateLastModified')->useCurrentOnUpdate()->useCurrent()->index('index_occurdatelastmodifed');

            $table->unique(['collid', 'dbpk'], 'index_collid');
            $table->unique(['occurrenceID'], 'unique_occurrenceid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('omoccurrences');
    }
};
