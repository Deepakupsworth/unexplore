<?php

namespace Database\Factories;

use App\Models\TransportTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportTranslationFactory extends Factory
{
    protected $model = TransportTranslation::class;

    public function definition(): array
    {
        return [
            'language_code' => $this->faker->randomElement(['en', 'de', 'fr']),
            'name' => $this->faker->word(),
            'description' => $this->faker->optional()->sentence(12),
        ];
    }
}
