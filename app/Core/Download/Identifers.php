<?php

namespace App\Core\Download;

class Identifers {
    use RowMap;

    public static $casts = [
        'occid' => 'coreid',
        'identifierValue' => 'identifier',
        'identifierName' => 'title',
    ];

    public static $ignores = [];

    public static $derived = [];

    public static $fields = [
        'coreid' => null,
        'identifier' => null,
        'title' => null,
        'format' => null,
        'recordID' => null,
        'format' => null,
        'initialTimestamp' => null,
    ];
}
