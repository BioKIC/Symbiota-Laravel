<?php

namespace App\Faker;

use Illuminate\Support\Str;

class TaxonomyProvider extends \Faker\Provider\Base {
    protected static $kingdoms = ['Animalia', 'Plantae', 'Fungi', 'Protista', 'Eubacteria', 'Archaebateria'];

    /* Only for Plantae Currently */
    protected static $taxonomyFormats = [
        '{{ genus }} {{ species }}',
        '{{genus}} {{species}} subsp. {{subspecies}}',
        '{{genus}} {{species}} subsp. {{subspecies}} var. {{variety}}',
        '{{genus}} {{species}} var. {{variety}} \'{{cultivar}}\'',
        '{{genus}} {{species}} \'{{cultivar}}\'',
    ];

    protected $kingdom = 'Plantae';

    protected $genus;

    protected $species;

    private function clear_taxonomy() {
        $this->genus = null;
        $this->species = null;
        //$this->subspecies = null;
    }

    public function kingdom() {
        $this->kingdom = $this->kingdom ?? static::randomElements(static::$kingdoms);

        return $this->kingdom;
    }

    public function genus() {
        $this->genus = $this->genus ?? static::randomElements(array_keys(static::$taxonomy[$this->kingdom()]))[0];

        return $this->genus;
    }

    public function species() {
        $species_tree = static::$taxonomy[$this->kingdom()][$this->genus()];
        $this->species = $this->species ?? static::randomElements(array_values($species_tree))[0];

        return $this->species;
    }

    public function subspecies() {
        return Str::random(10);
    }

    public function variety() {
        return Str::random(10);
    }

    public function cultivar() {
        return Str::random(10);
    }

    protected function getTaxaTree() {
        if (! $this->kingdom) {
            return static::$taxonomy;
        } elseif (! $this->genus) {
            return static::$taxonomy[$this->kingdom];
        } elseif (! $this->species) {
            return static::$taxonomy[$this->kingdom][$this->genus];
        }
    }

    protected static $taxonomy = [
        'Animalia' => [],
        'Plantae' => [
            'Abies' => [
                'alba',
                'nebrodensis',
                'borisii-regis',
                'ephalonica',
                'nordmanniana',
            ],
            'Abroma' => [
                'augustum',
                'molle',
            ],
            'Azorina' => [
                'vidalli',
            ],
            'Brachyscome' => [
                'aculeata',
                'ascendens',
                'basaltica',
                'chrysoglossa',
                'ciliaris',
                'decipiens',
            ],
        ],
        'Fungi' => [],
        'Protista' => [],
        'Eubacteria' => [],
        'Archaebateria' => [],
    ];

    public function taxonomicName() {
        $format = static::randomElements(static::$taxonomyFormats);
        $result = $this->generator->parse($format)[0];
        $this->clear_taxonomy();

        return $result;
    }
}
