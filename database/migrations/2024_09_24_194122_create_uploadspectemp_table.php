<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('uploadspectemp', function (Blueprint $table) {
            $table->unsignedInteger('collid')->index('fk_uploadspectemp_coll');
            $table->string('dbpk', 150)->nullable()->index('index_uploadspectemp_dbpk');
            $table->unsignedInteger('occid')->nullable()->index('index_uploadspectemp_occid');
            $table->string('basisOfRecord', 32)->nullable()->comment('PreservedSpecimen, LivingSpecimen, HumanObservation');
            $table->string('occurrenceID')->nullable()->comment('UniqueGlobalIdentifier');
            $table->string('catalogNumber', 32)->nullable()->index('index_uploadspec_catalognumber');
            $table->string('otherCatalogNumbers')->nullable()->index('index_uploadspec_othercatalognumbers');
            $table->string('ownerInstitutionCode', 32)->nullable();
            $table->string('institutionID')->nullable();
            $table->string('collectionID')->nullable();
            $table->string('datasetID')->nullable();
            $table->string('organismID', 150)->nullable();
            $table->string('institutionCode', 64)->nullable();
            $table->string('collectionCode', 64)->nullable();
            $table->string('family')->nullable();
            $table->string('scientificName')->nullable();
            $table->string('sciname')->nullable()->index('index_uploadspec_sciname');
            $table->unsignedInteger('tidinterpreted')->nullable();
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
            $table->string('typeStatus')->nullable();
            $table->string('recordedBy')->nullable()->comment('Collector(s)');
            $table->string('recordNumberPrefix', 45)->nullable();
            $table->string('recordNumberSuffix', 45)->nullable();
            $table->string('recordNumber', 32)->nullable()->comment('Collector Number');
            $table->string('CollectorFamilyName')->nullable()->comment('not DwC');
            $table->string('CollectorInitials')->nullable()->comment('not DwC');
            $table->string('associatedCollectors')->nullable()->comment('not DwC');
            $table->date('eventDate')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->integer('startDayOfYear')->nullable();
            $table->integer('endDayOfYear')->nullable();
            $table->date('LatestDateCollected')->nullable();
            $table->string('verbatimEventDate')->nullable();
            $table->text('habitat')->nullable()->comment('Habitat, substrait, etc');
            $table->string('substrate', 500)->nullable();
            $table->string('host', 250)->nullable();
            $table->text('fieldNotes')->nullable();
            $table->string('fieldnumber', 45)->nullable();
            $table->string('eventID', 45)->nullable();
            $table->text('occurrenceRemarks')->nullable()->comment('General Notes');
            $table->string('informationWithheld', 250)->nullable();
            $table->string('dataGeneralizations', 250)->nullable();
            $table->text('associatedOccurrences')->nullable();
            $table->text('associatedMedia')->nullable();
            $table->text('associatedReferences')->nullable();
            $table->text('associatedSequences')->nullable();
            $table->text('associatedTaxa')->nullable()->comment('Associated Species');
            $table->text('dynamicProperties')->nullable()->comment('Plant Description?');
            $table->text('verbatimAttributes')->nullable();
            $table->string('behavior', 500)->nullable();
            $table->string('reproductiveCondition')->nullable()->comment('Phenology: flowers, fruit, sterile');
            $table->integer('cultivationStatus')->nullable()->comment('0 = wild, 1 = cultivated');
            $table->string('establishmentMeans', 32)->nullable()->comment('cultivated, invasive, escaped from captivity, wild, native');
            $table->string('lifeStage', 45)->nullable();
            $table->string('sex', 45)->nullable();
            $table->string('individualCount', 45)->nullable();
            $table->string('samplingProtocol', 100)->nullable();
            $table->string('samplingEffort', 200)->nullable();
            $table->string('preparations', 100)->nullable();
            $table->string('locationID', 150)->nullable();
            $table->string('parentLocationID', 150)->nullable();
            $table->string('continent', 45)->nullable();
            $table->string('waterBody', 150)->nullable();
            $table->string('islandGroup', 75)->nullable();
            $table->string('island', 75)->nullable();
            $table->string('countryCode', 5)->nullable();
            $table->string('country', 64)->nullable();
            $table->string('stateProvince')->nullable();
            $table->string('county')->nullable();
            $table->string('municipality')->nullable();
            $table->text('locality')->nullable();
            $table->integer('localitySecurity')->nullable()->default(0)->comment('0 = display locality, 1 = hide locality');
            $table->string('localitySecurityReason', 100)->nullable();
            $table->double('decimalLatitude')->nullable();
            $table->double('decimalLongitude')->nullable();
            $table->string('geodeticDatum')->nullable();
            $table->unsignedInteger('coordinateUncertaintyInMeters')->nullable();
            $table->text('footprintWKT')->nullable();
            $table->decimal('coordinatePrecision', 9, 7)->nullable();
            $table->text('locationRemarks')->nullable();
            $table->string('verbatimCoordinates')->nullable();
            $table->string('verbatimCoordinateSystem')->nullable();
            $table->integer('latDeg')->nullable();
            $table->double('latMin')->nullable();
            $table->double('latSec')->nullable();
            $table->string('latNS', 3)->nullable();
            $table->integer('lngDeg')->nullable();
            $table->double('lngMin')->nullable();
            $table->double('lngSec')->nullable();
            $table->string('lngEW', 3)->nullable();
            $table->string('verbatimLatitude', 45)->nullable();
            $table->string('verbatimLongitude', 45)->nullable();
            $table->string('UtmNorthing', 45)->nullable();
            $table->string('UtmEasting', 45)->nullable();
            $table->string('UtmZoning', 45)->nullable();
            $table->string('trsTownship', 45)->nullable();
            $table->string('trsRange', 45)->nullable();
            $table->string('trsSection', 45)->nullable();
            $table->string('trsSectionDetails', 45)->nullable();
            $table->string('georeferencedBy')->nullable();
            $table->dateTime('georeferencedDate')->nullable();
            $table->string('georeferenceProtocol')->nullable();
            $table->string('georeferenceSources')->nullable();
            $table->string('georeferenceVerificationStatus', 32)->nullable();
            $table->string('georeferenceRemarks')->nullable();
            $table->integer('minimumElevationInMeters')->nullable();
            $table->integer('maximumElevationInMeters')->nullable();
            $table->string('elevationNumber', 45)->nullable();
            $table->string('elevationUnits', 45)->nullable();
            $table->string('verbatimElevation')->nullable();
            $table->integer('minimumDepthInMeters')->nullable();
            $table->integer('maximumDepthInMeters')->nullable();
            $table->string('verbatimDepth', 50)->nullable();
            $table->text('previousIdentifications')->nullable();
            $table->string('disposition', 32)->nullable()->comment('Dups to');
            $table->string('storageLocation', 100)->nullable();
            $table->string('genericcolumn1', 100)->nullable();
            $table->string('genericcolumn2', 100)->nullable();
            $table->integer('exsiccatiIdentifier')->nullable();
            $table->string('exsiccatiNumber', 45)->nullable();
            $table->string('exsiccatiNotes', 250)->nullable();
            $table->text('paleoJSON')->nullable();
            $table->text('materialSampleJSON')->nullable();
            $table->dateTime('modified')->nullable()->comment('DateLastModified');
            $table->string('language', 20)->nullable();
            $table->string('recordEnteredBy', 250)->nullable();
            $table->unsignedInteger('duplicateQuantity')->nullable();
            $table->string('labelProject', 45)->nullable();
            $table->string('processingStatus', 45)->nullable();
            $table->text('tempfield01')->nullable();
            $table->text('tempfield02')->nullable();
            $table->text('tempfield03')->nullable();
            $table->text('tempfield04')->nullable();
            $table->text('tempfield05')->nullable();
            $table->text('tempfield06')->nullable();
            $table->text('tempfield07')->nullable();
            $table->text('tempfield08')->nullable();
            $table->text('tempfield09')->nullable();
            $table->text('tempfield10')->nullable();
            $table->text('tempfield11')->nullable();
            $table->text('tempfield12')->nullable();
            $table->text('tempfield13')->nullable();
            $table->text('tempfield14')->nullable();
            $table->text('tempfield15')->nullable();
            $table->timestamp('initialTimestamp')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploadspectemp');
    }
};