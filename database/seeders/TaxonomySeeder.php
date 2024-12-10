<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySeeder extends Seeder {
    // Note I (@Muchquak) am not a biologist as so this variable name is not correct
    // [rank_name, [rank_id, dir_parent_id, reqparentrankid]]
    private static $plants = [
        'Organism' => [1, 1, 1],
        'Kingdom' => [10, 1, 1],
        'Subkingdom' => [20, 10, 10],
        'Division' => [30, 20, 10],
        'Subdivision' => [40, 30, 30],
        'Superclass' => [50, 40, 30],
        'Class' => [60, 50, 30],
        'Subclass' => [70, 60, 60],
        'Order' => [100, 70, 60],
        'Suborder' => [110, 100, 100],
        'Family' => [140, 110, 100],
        'Subfamily' => [150, 140, 140],
        'Tribe' => [160, 150, 140],
        'Subtribe' => [170, 160, 140],
        'Genus' => [180, 170, 140],
        'Subgenus' => [190, 180, 180],
        'Section' => [200, 190, 180],
        'Subsection' => [210, 200, 180],
        'Species' => [220, 210, 180],
        'Subspecies' => [230, 220, 180],
        'Variety' => [240, 220, 180],
        'Subvariety' => [250, 240, 180],
        'Form' => [260, 220, 180],
        'Subform' => [270, 260, 180],
        'Cultivated' => [300, 220, 220],
    ];

    // Note I (@Muchquak) am not a biologist as so this variable name is not correct
    // [rank_name, [rank_id, dir_parent_id, reqparentrankid]]
    private static $animals = [
        'Organism' => [1, 1, 1],
        'Kingdom' => [10, 1, 1],
        'Subkingdom' => [20, 10, 10],
        'Phylum' => [30, 20, 10],
        'Subphylum' => [40, 30, 30],
        'Class' => [60, 50, 30],
        'Subclass' => [70, 60, 60],
        'Order' => [100, 70, 60],
        'Suborder' => [110, 100, 100],
        'Family' => [140, 110, 100],
        'Subfamily' => [150, 140, 140],
        'Tribe' => [160, 150, 140],
        'Subtribe' => [170, 160, 140],
        'Genus' => [180, 170, 140],
        'Subgenus' => [190, 180, 180],
        'Species' => [220, 210, 180],
        'Subspecies' => [230, 220, 180],
        'Morph' => [240, 220, 180],
    ];

    /**
     * @param  mixed  $kingdom_names
     * @param  mixed  $rank_tree
     */
    private static function load_taxon_units($kingdom_names, $rank_tree): void {
        foreach ($kingdom_names as $kingdom_name) {
            foreach ($rank_tree as $rank_name => $rank_arr) {
                DB::table('taxonunits')->insert([
                    'kingdomName' => $kingdom_name,
                    'rankid' => $rank_arr[0],
                    'rankname' => $rank_name,
                    'dirparentrankid' => $rank_arr[1],
                    'reqparentrankid' => $rank_arr[2],
                ]);
            }
        }
    }

    /**
     * Run the database seeds.
     */
    public function run(): void {

        /**
         * Add Default Taxonomic Thesaurus
         */
        DB::table('taxauthority')->insert([
            'taxauthid' => 1,
            'isPrimary' => 1,
            'name' => 'Central Thesaurus',
            'isActive' => 1,
        ]);

        self::load_taxon_units(['Organism', 'Plantae', 'Fungi'], self::$plants);
        self::load_taxon_units(['Monera', 'Protista', 'Animalia'], self::$animals);

        foreach (['Organism', 'Monera', 'Protista', 'Plantae', 'Fungi', 'Animalia'] as $kingdom) {
            $rank_id = $kingdom === 'Organism' ? 1 : 10;
            DB::table('taxa')->insert([
                'rankID' => $rank_id,
                'sciName' => $kingdom,
                'unitName1' => $kingdom,
            ]);

            DB::insert('INSERT INTO taxaenumtree (tid, taxauthid, parenttid) VALUES (LAST_INSERT_ID(), 1, 1)');
        }
    }
}
