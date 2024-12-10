<?php

namespace Database\Factories;

use App\Models\Occurrence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Occurrence>
 */
class OccurrenceFactory extends Factory {
    protected $model = Occurrence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            //This is required and must be passed in
            'collid' => null,
            'locality' => fake()->country(),
        ];
    }
}
