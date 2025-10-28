<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityTranslationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'language_id' => \App\Models\Language::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->city,
            'tagline' => $this->faker->sentence(6),
            'about' => $this->faker->paragraph(4),
        ];
    }
}

