<?php

namespace App\Core\Download;

class Determinations {
    use RowMap;

    public static $casts = [
        'occid' => 'coreid',
        'sciname' => 'scientificName',
        'dateLastModified' => 'modified',
        'taxonRank' => 'verbatimTaxonRank',
    ];

    public static $ignores = [];

    public static $derived = [];

    public static $fields = [
        'coreid' => null,
        'identifiedBy' => null,
        'dateIdentified' => null,
        'identificationQualifier' => null,
        'scientificName' => null,
        'scientificNameAuthorship' => null,
        'genus' => null,
        'specificEpithet' => null,
        'taxonRank' => null,
        'infraspecificEpithet' => null,
        'identificationReferences' => null,
        'identificationRemarks' => null,
        'recordID' => null,
        'modified' => null,
    ];
}
