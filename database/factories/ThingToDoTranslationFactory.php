<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThingToDoTranslationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'language_id' => \App\Models\Language::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->sentence(3),
            'about' => $this->faker->paragraph(4),
        ];
    }
}

