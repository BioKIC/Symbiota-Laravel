<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Institution;
use App\Models\Occurrence;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $inst = Institution::factory()->create();
        $collection = Collection::factory()->create([
            'iid' => $inst->iid,
            'institutionCode' => $inst->InstitutionCode,
        ]);

        $occurrence = Occurrence::factory(10000)->create([
            'collid' => $collection->collid,
        ]);
    }
}
