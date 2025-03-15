<?php

namespace App\Http\Controllers;

use App\Core\Download\AttributeTraits;
use App\Core\Download\DarwinCore;
use App\Core\Download\Determinations;
use App\Core\Download\Identifers;
use App\Core\Download\Multimedia;
use App\Core\Download\SymbiotaNative;
use App\Models\Occurrence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class DownloadController extends Controller {
    public static function getHigherClassification($tid) {
        $taxa_info = DB::select("
            select t.*, flat_enum_tree.taxa_enums from taxa as t INNER JOIN taxstatus ts ON t.tid = ts.tid
            JOIN (
                SELECT e.tid ,group_concat(CONCAT(t.sciName, ':', t.rankid) ORDER BY t.rankid) as taxa_enums
                    FROM taxaenumtree e
                    INNER JOIN taxa t ON e.parentTid = t.tid
                    WHERE e.taxauthid = 1
                    AND e.tid in (?)
                group by e.tid
            ) as flat_enum_tree on flat_enum_tree.tid = t.tid
            where t.tid in (?) and ts.taxauthid = 1
            ", [$tid, $tid]);

        $result = [];

        foreach ($taxa_info as $key => $value) {
            $ident_tree = [];
            foreach (explode(',', $value->taxa_enums) as $idx => $ident) {
                [$rankName, $rankID] = explode(':', $ident);

                $ident_tree[] = $rankName;

                $order_name = match (intval($rankID)) {
                    10 => 'kingdom',
                    30 => 'phylum',
                    60 => 'class',
                    100 => 'order',
                    140 => 'family',
                    190 => 'subgenus',
                    default => false,
                };

                if ($order_name) {
                    $result[$value->tid][$order_name] = $rankName;
                }
            }

            $result[$value->tid]['higherClassification'] = implode('|', $ident_tree);
            //$result[$value->tid]['unitInd3'] = $value->unitInd3;
            $result[$value->tid]['cultivarEpithet'] = $value->cultivarEpithet;
            $result[$value->tid]['tradeName'] = $value->tradeName;
        }

        return $result;
    }

    public static function downloadPage(Request $request) {
        $params = $request->except(['page', '_token']);

        return view('pages/collections/download');
    }

    public static function process_occurrence_row($unmapped_row, $SCHEMA) {
        $row = $SCHEMA::$fields;
        foreach ($unmapped_row as $key => $value) {
            if (array_key_exists($key, $SCHEMA::$ignores)) {
                continue;
            }

            // Map Casted Values
            if (array_key_exists($key, $SCHEMA::$casts)) {
                if (array_key_exists($SCHEMA::$casts[$key], $row)) {
                    $row[$SCHEMA::$casts[$key]] = $value;
                }
            }
            // Map DB Values
            elseif (array_key_exists($key, $row)) {
                $row[$key] = $value;
            }

            // Generate Row Dervied Values
            foreach ($SCHEMA::$derived as $key => $fn) {
                if (array_key_exists($key, $row) && ! $row[$key]) {
                    $row[$key] = $SCHEMA::callDerived($key, $unmapped_row);
                }
            }
        }

        return $row;
    }

    public static function check_schema(Request $request) {
        // Pick schema
        $SCHEMA = DarwinCore::class;

        // Build Query
        $query = Occurrence::buildSelectQuery($request->all());

        if (array_key_exists('associatedSequences', $SCHEMA::$fields)) {
            $geneticsQuery = DB::table('omoccurgenetic')->selectRaw(
                "occid as gen_occid, group_concat(CONCAT_WS(', ', resourcename, title, identifier, locus, resourceUrl) SEPARATOR ' | ') as associatedSequences"
            )->groupBy('occid');
            $query->leftJoinSub($geneticsQuery, 'gen', 'gen.gen_occid', 'o.occid');
        }

        //Get Occurrence Data
        $occurrences = $query->select(['c.*', 'gen.*', 'o.*'])->orderBy('o.occid')->limit(100)->get();

        //Get Associated Media Records
        $occ_media = DB::table('media')->select('*')->whereIn('occid', $occurrences->map(fn ($v) => $v->occid))->get();

        return [
            'occurrences' => $occurrences->map(fn ($row) => $SCHEMA::map_row((array) $row)),
            'multimedia' => $occ_media,
        ];
    }

    public static function downloadFile(Request $request) {
        $params = $request->except(['page', '_token']);

        if (empty($params)) {
            return [];
        }

        $SCHEMA = SymbiotaNative::class;
        if (request('schema') === 'dwc') {
            $SCHEMA = DarwinCore::class;
        }

        //Setup File Names
        $fileNames = [
            'occurrence' => 'occurrence.csv',
            'multimedia' => 'multimedia.csv',
            'identifiers' => 'identifiers.csv',
            'measurementOrFact' => 'measurementOrFact.csv',
            'identifications' => 'identifications.csv',
            'eml' => 'eml.xml',
            'meta' => 'meta.xml',
            'CITEME' => 'CITEME.txt',
        ];

        //Build Occurrence Query
        $query = Occurrence::buildSelectQuery($request->all());
        if (array_key_exists('associatedSequences', $SCHEMA::$fields)) {
            $geneticsQuery = DB::table('omoccurgenetic')->selectRaw(
                "occid as gen_occid, group_concat(CONCAT_WS(', ', resourcename, title, identifier, locus, resourceUrl) SEPARATOR ' | ') as associatedSequences"
            )->groupBy('occid');
            $query->leftJoinSub($geneticsQuery, 'gen', 'gen.gen_occid', 'o.occid');
        }

        $taxa = [];
        $files = [];
        foreach ($fileNames as $key => $fileName) {
            $files[$key] = fopen($fileName, 'w');
        }

        //Write CSV Headers
        fputcsv($files['occurrence'], array_keys($SCHEMA::$fields));
        fputcsv($files['multimedia'], array_keys(Multimedia::$fields));
        fputcsv($files['identifiers'], array_keys(Identifers::$fields));

        //This order matters when dealing with conflicting attribute names
        $query->select(['c.*', 'gen.*', 'o.*'])->orderBy('o.occid')->chunk(1000, function (\Illuminate\Support\Collection $occurrences) use (&$files, &$taxa, $SCHEMA) {
            // Process Occurrence Data
            $occids = [];
            foreach ($occurrences as $occurrence) {
                array_push($occids, $occurrence->occid);

                if ($occurrence->tidInterpreted) {
                    if (! array_key_exists($occurrence->tidInterpreted, $taxa)) {
                        $taxa[$occurrence->tidInterpreted] = self::getHigherClassification($occurrence->tidInterpreted)[$occurrence->tidInterpreted];
                    }
                }

                $unmapped_row = array_merge(
                    (array) $occurrence,
                    $occurrence->tidInterpreted && array_key_exists($occurrence->tidInterpreted, $taxa) ? $taxa[$occurrence->tidInterpreted] : []
                );

                $row = $SCHEMA::map_row($unmapped_row);

                fputcsv($files['occurrence'], (array) $row);
            }

            //Process Media
            $occ_media = DB::table('media')->select('*')->whereIn('occid', $occids)->get();
            foreach ($occ_media as $media_row) {
                $row = Multimedia::map_row((array) $media_row);
                fputcsv($files['multimedia'], (array) $row);
            }

            //Process identifiers
            $occ_identifiers = DB::table('omoccuridentifiers')->select('*')->whereIn('occid', $occids)->get();
            foreach ($occ_identifiers as $identifier_row) {
                $row = Identifers::map_row((array) $identifier_row);
                fputcsv($files['identifiers'], (array) $row);
            }

            //Process identifications
            $occ_determinations = DB::table('omoccurdeterminations')->select('*')->whereIn('occid', $occids)->get();
            foreach ($occ_determinations as $determination_row) {
                $row = Determinations::map_row((array) $determination_row);
                fputcsv($files['identifications'], (array) $row);
            }

            //Process measurementOrFact
            $occ_attribute_traits = [];
            foreach ($occ_attribute_traits as $attribute_trait_row) {
                $row = AttributeTraits::map_row((array) $attribute_trait_row);
                fputcsv($files['measurementOrFact'], (array) $row);
            }
        });

        //Close all working files
        foreach ($files as $key => $file) {
            fclose($file);
        }

        $zipArchive = new ZipArchive();
        //. date('Y-m-d_His')
        $archiveFileName = 'SymbOuput_date_DwC-A.zip';
        if (! ($status = $zipArchive->open($archiveFileName, ZipArchive::CREATE))) {
            exit('FATAL ERROR: unable to create archive file: ' . $status);
        }

        foreach ($fileNames as $key => $file) {
            $zipArchive->addFile($file);
        }

        $zipArchive->close();

        //Delete All working files
        foreach ($fileNames as $key => $file) {
            unlink($file);
        }

        return response()->download(public_path($archiveFileName))->deleteFileAfterSend(true);
    }
}
