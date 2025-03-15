<?php

namespace App\Core\Download;

class AttributeTraits {
    use RowMap;

    public static $casts = [
        'occid' => 'coreid',
        'traitname' => 'measurementType',
        'refurl' => 'measurementTypeID',
        'units' => 'measurementUnit',
        'username' => 'measurementDeterminedBy',
        'notes' => 'measurementRemarks',
    ];

    public static $ignores = [];

    public static $derived = [
        'measurementValue' => 'derive_measurement_value',
    ];

    public static $fields = [
        'coreid',
        'measurementType',
        'measurementTypeID',
        'measurementValue',
        'measurementUnit',
        'measurementDeterminedDate',
        'measurementDeterminedBy',
        'measurementRemarks',
    ];

    public function derive_measurement_value($row) {
        if (array_key_exists('xvalue', $row)) {
            return $row['xvalue'];
        } elseif (array_key_exists('statename', $row)) {
            return $row['statename'];
        }
    }

    public function derive_measurement_determined_date($row) {
        //TODO (Logan) format dates to "%Y-%m-%dT%TZ"
        if (array_key_exists('datelastmodified', $row)) {
            return $row['datelastmodified'];
        } elseif (array_key_exists('initialtimestamp', $row)) {
            return $row['initialtimestamp'];
        }
    }
}
