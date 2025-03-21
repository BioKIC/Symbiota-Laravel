<?php

namespace App\Core\Download;

class DarwinCore {
    use DeriveCombineOccurrenceRecordID;
    use DeriveOccurrenceReference;
    use DeriveTaxonRank;
    use RowMap;

    public static $casts = [
        'occid' => 'id',
        'tidInterpreted' => 'taxonID',
        'taxonRank' => 'verbatimTaxonRank',
        'collectionGuid' => 'collectionID',
        'dateLastModified' => 'modified',
    ];

    public static $ignores = [];

    public static $derived = [
        'references' => 'derive_references',
        'recordID' => 'derive_combine_occurrence_record_id',
        'occurrenceID' => 'derive_combine_occurrence_record_id',
        'taxonRank' => 'derive_taxon_rank',
    ];

    public static $fields = [
        'id' => null,
        'institutionCode' => null,
        'collectionCode' => null,
        'ownerInstitutionCode' => null,
        'collectionID' => null,
        'basisOfRecord' => null,
        'occurrenceID' => null,
        'catalogNumber' => null,
        'otherCatalogNumbers' => null,
        'higherClassification' => null,
        'kingdom' => null,
        'phylum' => null,
        'class' => null,
        'order' => null,
        'family' => null,
        'scientificName' => null,
        'taxonID' => null,
        'scientificNameAuthorship' => null,
        'genus' => null,
        'subgenus' => null,
        'specificEpithet' => null,
        'verbatimTaxonRank' => null,
        'infraspecificEpithet' => null,
        'cultivarEpithet' => null,
        'taxonRank' => null,
        'identifiedBy' => null,
        'dateIdentified' => null,
        'identificationReferences' => null,
        'identificationRemarks' => null,
        'taxonRemarks' => null,
        'identificationQualifier' => null,
        'typeStatus' => null,
        'recordedBy' => null,
        'recordNumber' => null,
        'eventDate' => null,
        'year' => null,
        'month' => null,
        'day' => null,
        'startDayOfYear' => null,
        'endDayOfYear' => null,
        'verbatimEventDate' => null,
        'occurrenceRemarks' => null,
        'habitat' => null,
        'behavior' => null,
        'vitality' => null,
        'fieldNumber' => null,
        'eventID' => null,
        'informationWithheld' => null,
        'dataGeneralizations' => null,
        'dynamicProperties' => null,
        'associatedOccurrences' => null,
        'associatedSequences' => null,
        'associatedTaxa' => null,
        'reproductiveCondition' => null,
        'establishmentMeans' => null,
        'lifeStage' => null,
        'sex' => null,
        'individualCount' => null,
        'samplingProtocol' => null,
        'preparations' => null,
        'locationID' => null,
        'continent' => null,
        'waterBody' => null,
        'islandGroup' => null,
        'island' => null,
        'country' => null,
        'countryCode' => null,
        'stateProvince' => null,
        'county' => null,
        'municipality' => null,
        'locality' => null,
        'locationRemarks' => null,
        'decimalLatitude' => null,
        'decimalLongitude' => null,
        'geodeticDatum' => null,
        'coordinateUncertaintyInMeters' => null,
        'verbatimCoordinates' => null,
        'georeferencedBy' => null,
        'georeferenceProtocol' => null,
        'georeferenceSources' => null,
        'georeferenceVerificationStatus' => null,
        'georeferenceRemarks' => null,
        'minimumElevationInMeters' => null,
        'maximumElevationInMeters' => null,
        'minimumDepthInMeters' => null,
        'maximumDepthInMeters' => null,
        'verbatimDepth' => null,
        'verbatimElevation' => null,
        'disposition' => null,
        'language' => null,
        'recordEnteredBy' => null,
        'modified' => null,
        'rights' => null,
        'rightsHolder' => null,
        'accessRights' => null,
        'recordID' => null,
        'references' => null,
    ];

    public static $terms = [
        'institutionCode' => Terms::DARWIN_CORE,
        'collectionCode' => Terms::DARWIN_CORE,
        'ownerInstitutionCode' => Terms::DARWIN_CORE,
        'collectionID' => Terms::DARWIN_CORE,
        'basisOfRecord' => Terms::DARWIN_CORE,
        'occurrenceID' => Terms::DARWIN_CORE,
        'catalogNumber' => Terms::DARWIN_CORE,
        'otherCatalogNumbers' => Terms::DARWIN_CORE,
        'higherClassification' => Terms::DARWIN_CORE,
        'kingdom' => Terms::DARWIN_CORE,
        'phylum' => Terms::DARWIN_CORE,
        'class' => Terms::DARWIN_CORE,
        'order' => Terms::DARWIN_CORE,
        'family' => Terms::DARWIN_CORE,
        'scientificName' => Terms::DARWIN_CORE,
        'taxonID' => Terms::DARWIN_CORE,
        'scientificNameAuthorship' => Terms::DARWIN_CORE,
        'genus' => Terms::DARWIN_CORE,
        'subgenus' => Terms::DARWIN_CORE,
        'specificEpithet' => Terms::DARWIN_CORE,
        'verbatimTaxonRank' => Terms::DARWIN_CORE,
        'infraspecificEpithet' => Terms::DARWIN_CORE,
        'cultivarEpithet' => Terms::DARWIN_CORE,
        'taxonRank' => Terms::DARWIN_CORE,
        'identifiedBy' => Terms::DARWIN_CORE,
        'dateIdentified' => Terms::DARWIN_CORE,
        'identificationReferences' => Terms::DARWIN_CORE,
        'identificationRemarks' => Terms::DARWIN_CORE,
        'taxonRemarks' => Terms::DARWIN_CORE,
        'identificationQualifier' => Terms::DARWIN_CORE,
        'typeStatus' => Terms::DARWIN_CORE,
        'recordedBy' => Terms::DARWIN_CORE,
        'recordNumber' => Terms::DARWIN_CORE,
        'eventDate' => Terms::DARWIN_CORE,
        'year' => Terms::DARWIN_CORE,
        'month' => Terms::DARWIN_CORE,
        'day' => Terms::DARWIN_CORE,
        'startDayOfYear' => Terms::DARWIN_CORE,
        'endDayOfYear' => Terms::DARWIN_CORE,
        'verbatimEventDate' => Terms::DARWIN_CORE,
        'occurrenceRemarks' => Terms::DARWIN_CORE,
        'habitat' => Terms::DARWIN_CORE,
        'behavior' => Terms::DARWIN_CORE,
        'vitality' => Terms::DARWIN_CORE,
        'fieldNumber' => Terms::DARWIN_CORE,
        'eventID' => Terms::DARWIN_CORE,
        'informationWithheld' => Terms::DARWIN_CORE,
        'dataGeneralizations' => Terms::DARWIN_CORE,
        'dynamicProperties' => Terms::DARWIN_CORE,
        'associatedOccurrences' => Terms::DARWIN_CORE,
        'associatedSequences' => Terms::DARWIN_CORE,
        'associatedTaxa' => Terms::DARWIN_CORE,
        'reproductiveCondition' => Terms::DARWIN_CORE,
        'establishmentMeans' => Terms::DARWIN_CORE,
        'lifeStage' => Terms::DARWIN_CORE,
        'sex' => Terms::DARWIN_CORE,
        'individualCount' => Terms::DARWIN_CORE,
        'samplingProtocol' => Terms::DARWIN_CORE,
        'preparations' => Terms::DARWIN_CORE,
        'locationID' => Terms::DARWIN_CORE,
        'continent' => Terms::DARWIN_CORE,
        'waterBody' => Terms::DARWIN_CORE,
        'islandGroup' => Terms::DARWIN_CORE,
        'island' => Terms::DARWIN_CORE,
        'country' => Terms::DARWIN_CORE,
        'countryCode' => Terms::DARWIN_CORE,
        'stateProvince' => Terms::DARWIN_CORE,
        'county' => Terms::DARWIN_CORE,
        'municipality' => Terms::DARWIN_CORE,
        'locality' => Terms::DARWIN_CORE,
        'locationRemarks' => Terms::DARWIN_CORE,
        'decimalLatitude' => Terms::DARWIN_CORE,
        'decimalLongitude' => Terms::DARWIN_CORE,
        'geodeticDatum' => Terms::DARWIN_CORE,
        'coordinateUncertaintyInMeters' => Terms::DARWIN_CORE,
        'verbatimCoordinates' => Terms::DARWIN_CORE,
        'georeferencedBy' => Terms::DARWIN_CORE,
        'georeferenceProtocol' => Terms::DARWIN_CORE,
        'georeferenceSources' => Terms::DARWIN_CORE,
        'georeferenceVerificationStatus' => Terms::DARWIN_CORE,
        'georeferenceRemarks' => Terms::DARWIN_CORE,
        'minimumElevationInMeters' => Terms::DARWIN_CORE,
        'maximumElevationInMeters' => Terms::DARWIN_CORE,
        'minimumDepthInMeters' => Terms::DARWIN_CORE,
        'maximumDepthInMeters' => Terms::DARWIN_CORE,
        'verbatimDepth' => Terms::DARWIN_CORE,
        'verbatimElevation' => Terms::DARWIN_CORE,
        'disposition' => Terms::DARWIN_CORE,
        'language' => Terms::DUBLIN_CORE,
        'recordEnteredBy' => Terms::SYMBIOTA,
        'modified' => Terms::DUBLIN_CORE,
        'rights' => Terms::DUBLIN_CORE,
        'rightsHolder' => Terms::DUBLIN_CORE,
        'accessRights' => Terms::DUBLIN_CORE,
        'recordID' => Terms::SYMBIOTA,
        'references' => Terms::DUBLIN_CORE,
    ];
}
